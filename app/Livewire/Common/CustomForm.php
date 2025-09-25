<?php
namespace App\Livewire\Common;

use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\Features\SupportFileUploads\WithFileUploads;

class CustomForm extends Component
{

    use WithFileUploads;

    public $fields = [];

    public array $formData             = [];
    public array $rules                = [];
    public array $validationAttributes = [];

    public $submitEvent = 'form-submitted';
    public $formFieldData;
    public $isView;

    /**
     * Function: mount
     */
    public function mount(array $fields = [], string $submitEvent = '', array $formFieldData = [], bool $isView = false)
    {
        $this->fields        = $fields;
        $this->isView        = $isView;
        $this->formFieldData = $formFieldData;

        if ($submitEvent) {
            $this->submitEvent = $submitEvent;
        }

        foreach ($this->fields['fields'] ?? [] as $field) {

            # Initialize form data value
            if (! empty($formFieldData)) {
                $this->formData[$field['name']] = $formFieldData[$field['name']];
            } else {

                $this->formData[$field['name']] = in_array($field['type'], ['file', 'image']) ? null : '';
            }

            if (! empty($field['validation'])) {

                if (in_array($field['type'], ['image', 'file']) && isset($this->formData[$field['name']])) {
                    $value = $this->formData[$field['name']];

                    if (! $value instanceof TemporaryUploadedFile) {
                        unset($this->rules['formData.' . $field['name']]);
                    }
                } elseif ($field['name'] === 'email' && isset($formFieldData['id'])) {
                    $this->rules['formData.email'] = 'required|email|unique:users,email,' . $formFieldData['id'];

                } else {
                    $this->rules['formData.' . $field['name']] = $field['validation'];
                }

                $this->validationAttributes['formData.' . $field['name']] = $field['label'] ?? $field['name'];
            }
        }
    }

    /**
     * For realtime validtion
     */
    public function updated($propertyName)
    {
        if (str_starts_with($propertyName, 'formData.')) {
            $this->validateOnly($propertyName, $this->rules, [], $this->validationAttributes);
        }
    }

    /**
     * Function: handleSubmit
     */
    public function handleSubmit()
    {
        $validatedData = $this->validate(rules: $this->rules, attributes: $this->validationAttributes);

        $formData = $validatedData['formData'] ?? [];

        foreach ($this->fields['fields'] as $field) {

            $name = $field['name'];

            # Handle file uploads
            if (in_array($field['type'], ['image', 'file'])) {
                $value = $this->formData[$name] ?? null;

                if ($value instanceof TemporaryUploadedFile) {

                    $uploadDir = $field['uploadDirectory'] ?? 'uploads';

                    $formData[$name] = $value->store($uploadDir, 'public');
                }
            }
        }

        # Dispatching event to parent component
        $this->dispatch($this->submitEvent, $formData);
    }

    public function render()
    {
        return view('livewire.common.custom-form');
    }
}
