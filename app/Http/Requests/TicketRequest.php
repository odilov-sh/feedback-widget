<?php

namespace App\Http\Requests;

use App\Data\TicketData;
use Illuminate\Validation\Rules\File;
use App\Rules\LimitTicketsByEmailRule;
use App\Rules\LimitTicketsByPhoneRule;
use Illuminate\Foundation\Http\FormRequest;

class TicketRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:255'],
            'email'   => ['required', 'email', 'max:255', new LimitTicketsByEmailRule],
            'phone'   => ['required', 'string', 'regex:/^\+[1-9]\d{1,14}$/', new LimitTicketsByPhoneRule],
            'subject' => ['required', 'string', 'max:255'],
            'text'    => ['required', 'string'],
            'files'   => ['nullable', 'array', ' max:5'],
            'files.*' => [
                'required',
                new File()
                    ->max('5mb')
                    ->extensions(['jpg', 'jpeg', 'png', 'pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'zip']),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'files.*.max'        => 'Each file must not be greater than 5 MB.',
            'files.*.extensions' => 'Each file must have one of the following extensions: jpg, jpeg, png, pdf, doc, docx, xls, xlsx, txt, zip.',
            'phone.regex'        => 'Please enter a valid phone number in E.164 format.',
        ];
    }

    public function toData(): TicketData
    {
        return TicketData::from($this->validated());
    }
}
