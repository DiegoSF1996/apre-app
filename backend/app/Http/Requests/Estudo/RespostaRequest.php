<?php

namespace App\Http\Requests\Estudo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class RespostaRequest extends FormRequest
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
			"questao_id" => ["required", "exists:questao,id"],

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
			"descricao.required" => "O campo descrição é obrigatório.",
			"descricao.max" => "O campo descrição deve ter no máximo 255 caracteres.",
			"questao_id.required" => "O campo questão é obrigatório.",
			"questao_id.exists" => "O campo questão é inválido.",
		];
	}

	protected function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(response()->json(['message' => 'Erro de validação de atributo', 'error' => $validator->errors()], Response::HTTP_NOT_ACCEPTABLE));
	}
}
