<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Atualizar mensagem</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="update">
                        <div class="row">
                            <div class="col-4 mb-2">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="text" class="form-control" v-model="messages.telefone">
                                </div>
                            </div>
                            <div class="col-3 mb-2">
                                <div class="form-gorup">
                                    <label>Data de envio</label>
                                    <input type="datetime-local" class="form-control" v-model="messages.data_envio">
                                </div>                                
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Mensagem</label>
                                    <textarea class="form-control" v-model="messages.mensagem"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Atualizar</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

import moment from 'moment';

export default {
    name:"messages",
    data(){
        return {
            messages:{
                telefone: "",
                data_envio: "",
                mensagem: ""
            }
        }
    },
    mounted(){
        this.showMessages()
    },
    methods:{
        async showMessages(){
            await this.axios.get(`/api/message/${this.$route.params.id}`).then(response=>{

                this.messages.telefone = response.data.telefone;
                this.messages.data_envio = moment(this.messages).format('YYYY-MM-DDThh:mm');
                this.messages.mensagem = response.data.mensagem;

            }).catch(error=>{
                console.log(error)
                this.messages = []
            })
        },
        async update(){
            await this.axios.put(`/api/message/${this.$route.params.id}`,this.messages).then(response=>{
                this.$router.push({name:"messageList"});
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>