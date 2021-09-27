<template>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Incluir Mensagem</h4>
                </div>
                <div class="card-body">
                    <form @submit.prevent="create">
                        <div class="row">
                            <div class="col-sm-6 sm-2">
                                <div class="form-group">
                                    <label>Telefone</label>
                                    <input type="text" class="form-control" v-model="message.telefone">
                                </div>
                            </div>
                            <div class="col-sm-6 sm-2">
                                <div class="form-group">
                                    <label>Data de envio</label>
                                    <input type="datetime-local" class="form-control" v-model="message.data_envio">
                                </div>
                            </div>
                            <div class="col-12 mb-2">
                                <div class="form-group">
                                    <label>Mensagem</label>
                                    <textarea class="form-control" v-model="message.mensagem"></textarea>
                                </div>
                            </div>
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary">Salvar</button>
                            </div>
                        </div>                        
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"add-message",
    data(){
        return {
            message:{
                tipo:"",
                modelo:""
            }
        }
    },
    methods:{
        async create(){
            await this.axios.post('/api/message',this.message).then(response=>{
                this.$router.push({name:"messageList"})
            }).catch(error=>{
                console.log(error)
            })
        }
    }
}
</script>