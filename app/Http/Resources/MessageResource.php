<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            "id" => $this->id,
            "telefone" => $this->telefone,
            "mensagem" => $this->mensagem,
            "data_envio" => date('d/m/Y h:i:s', strtotime($this->data_envio)),
            "enviado" => ($this->enviado ? true : false)
        ];
    }
}
