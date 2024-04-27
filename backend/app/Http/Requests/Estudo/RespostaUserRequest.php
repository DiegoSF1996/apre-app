<?php

namespace App\Http\Requests\Estudo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class RespostaUserRequest extends FormRequest
{
	public $id_request;

	public function authorize()
	{
		return true;
	}

	public function rules()
	{
		$this->id_request = $this->route('id');
		return match ($this->method()) {
			'POST' => $this->store(),
			'PUT', 'PATCH' => $this->update(),
			default => $this->view()
		};
	}

	public function store()
	{
		return [
			"resposta_id" => ["required", "exists:resposta,id"],
			"user_id" => ["required", "exists:users,id"],
		];
	}

	public function update()
	{
		return [];
	}

	public function view()
	{
		return [];
	}

	public function messages()
	{
		return [
			"resposta_id.required" => "O campo resposta é obrigatório.",
			"resposta_id.exists" => "O campo resposta deve ser valido.",
			"user_id.required" => "O campo usuário é obrigatório.",
			"user_id.exists" => "O campo usuário deve ser valido.",
		];
	}

	protected function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(response()->json(['message' => 'Erro de validação de atributo', 'error' => $validator->errors()], Response::HTTP_NOT_ACCEPTABLE));
	}
}
