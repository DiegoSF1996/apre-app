<?php

namespace App\Http\Requests\Estudo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class AssuntoRequest extends FormRequest
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
			"descricao" => ["required", "max:255"],
			"user_id" => ["required", "exists:user,id"],
			"assunto_id" => ["nullable", "exists:assunto,assunto_id"]
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
			"descricao.required"=> "A Descrição é obrigatória",
			"descricao.max"=> "A descrição deve ter no máximo 255 caracteres.",
			"user_id.required"=> "Usuário é obrigatório",
			"user_id.exists"=> "Usuário não encontrado",
			"assunto_id.exists"=> "Assunto não existe",
		];
	}

	protected function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(response()->json(['message' => 'Erro de validação de atributo', 'error' => $validator->errors()], Response::HTTP_NOT_ACCEPTABLE));
	}
}
