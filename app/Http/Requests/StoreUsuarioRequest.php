<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUsuarioRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed',
            'rol'      => 'required|in:administrador,veterinario',
            'nombre_completo' => 'nullable|required_if:rol,veterinario|string|max:255',
            'especialidad' => 'nullable|required_if:rol,veterinario|string|max:255',
            'cedula_profesional' => 'nullable|required_if:rol,veterinario|string|max:255',
            'foto_firma' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'     => 'El nombre es obligatorio.',
            'name.string'       => 'El nombre debe ser una cadena de texto.',
            'name.max'          => 'El nombre no puede tener más de 255 caracteres.',
            
            'email.required'    => 'El correo electrónico es obligatorio.',
            'email.email'       => 'El correo electrónico no tiene un formato válido.',
            'email.unique'      => 'Este correo electrónico ya está registrado.',
            
            'password.required' => 'La contraseña es obligatoria.',
            'password.min'      => 'La contraseña debe tener al menos 6 caracteres.',
            'password.confirmed'=> 'Las contraseñas no coinciden.',
            
            'rol.required'      => 'Debe seleccionar un rol.',
            'rol.in'            => 'El rol seleccionado no es válido.',
            
            'nombre_completo.required_if' => 'El nombre completo es obligatorio si el usuario es veterinario.',
            'especialidad.required_if'    => 'La especialidad es obligatoria si el usuario es veterinario.',
            'cedula_profesional.required_if' => 'La cédula profesional es obligatoria si el usuario es veterinario.',
            
            'foto_firma.image'  => 'El archivo subido debe ser una imagen.',
            'foto_firma.mimes'  => 'La imagen debe ser de tipo: jpeg, png, jpg, gif o svg.',
            'foto_firma.max'    => 'La imagen no debe pesar más de 2MB.',
        ];
    }
}
