<template>
    <div class="row">
        <div class="col-12 mb-2 text-end">
            <router-link :to='{name:"messageCreate"}' class="btn btn-primary">Incluir</router-link>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4>Mensagens</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Telefone</th>
                                    <th>Data de envio</th>
                                    <th>Mensagem</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody v-if="messages.length > 0">
                                <tr v-for="(message,key) in messages" :key="key">
                                    <td>{{ message.id }}</td>
                                    <td>{{ message.telefone }}</td>
                                    <td>{{ message.data_envio }}</td>
                                    <td v-if="message.mensagem.length>=15">{{ message.mensagem.substring(0,8)+"..." }}</td>
                                    <td v-else>{{ message.mensagem}}</td>
                                    <td>
                                        <router-link :to='{name:"messageEdit",params:{id: message.id}}' class="btn btn-success">Editar</router-link>
                                        <button type="button" @click="deleteMessage(message.id)" class="btn btn-danger">Excluir</button>
                                    </td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr>
                                    <td colspan="4" align="center">No Categories Found.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name:"messages",
    data(){
        return {
            messages:[]
        }
    },
    mounted(){
        this.getMessages()
    },
    methods:{
        async getMessages(){
            await this.axios.get('/api/message').then(response=>{
                this.messages = response.data
            }).catch(error=>{
                console.log(error)
                this.messages = []
            })
        },
        deleteMessage(id){
            if(confirm("Are you sure to delete this message ?")){
                this.axios.delete(`/api/message/${id}`).then(response=>{
                    this.$router.go(this.$router.currentRoute);
                }).catch(error=>{
                    console.log(error)
                })
            }
        }
    }
}
</script>