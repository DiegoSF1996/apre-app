<?php

namespace App\Http\Requests\Estudo;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Response;

class QuestaoRequest extends FormRequest
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
			"assunto_id" => ["required", "exists:assunto,id"],
			"tags" => ["nullable", "max:100"],
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
			"assunto_id.required" => "O campo assunto é obrigatório.",
			"assunto_id.exists" => "O campo assunto é inválido.",
			"tags.max" => "O campo tags deve ter no máximo 100 caracteres.",
		];
	}

	protected function failedValidation(Validator $validator)
	{
		throw new HttpResponseException(response()->json(['message' => 'Erro de validação de atributo', 'error' => $validator->errors()], Response::HTTP_NOT_ACCEPTABLE));
	}
}
