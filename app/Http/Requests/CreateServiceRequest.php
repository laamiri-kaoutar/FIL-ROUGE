<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        // Adjust based on your authorization logic
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'serviceTitle' => 'required|string|max:255',
            'serviceDescription' => 'required|string',
            'serviceStatus' => 'required|in:active,inactive',
            'serviceCategory' => 'required|exists:categories,id',
            'serviceTags' => 'required|array',
            'serviceTags.*' => 'exists:tags,id',
            'serviceImage' => 'nullable|image|max:5120', // 5MB max
            'packageName' => 'required|array',
            'packageName.*' => 'required|string|max:255',
            'packageType' => 'required|array',
            'packageType.*' => 'required|in:basic,standard,premium|distinct',
            'packagePrice' => 'required|array',
            'packagePrice.*' => 'required|numeric|min:0',
            'packageRevisions' => 'required|array',
            'packageRevisions.*' => 'required|integer|min:0',
            'packageDeliveryTime' => 'required|array',
            'packageDeliveryTime.*' => 'required|integer|min:1',
        ];
    }

    // Optional: Customize attribute names for error messages
    public function attributes(): array
    {
        return [
            'serviceTitle' => 'service title',
            'serviceDescription' => 'service description',
            'serviceStatus' => 'service status',
            'serviceCategory' => 'service category',
            'serviceTags' => 'service tags',
            'serviceImage' => 'service image',
            'packageName.*' => 'package name',
            'packageType.*' => 'package type',
            'packagePrice.*' => 'package price',
            'packageRevisions.*' => 'package revisions',
            'packageDeliveryTime.*' => 'package delivery time',
        ];
    }
}