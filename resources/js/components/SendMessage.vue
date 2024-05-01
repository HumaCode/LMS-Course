<template>
    <div>
        <!-- Button trigger modal -->
        <div class="text-center">
            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#exampleModal">
                Chat Now
            </button>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Chat With {{ receivername }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            
            <form @submit.prevent="sendMsg()">
                <div class="modal-body">
                    
                    <textarea class="form-control" v-model="form.msg" rows="3" placeholder="Type your message"></textarea>
                    <span class="text-success" v-if="succMessage.message" >{{ succMessage.message }}</span>
                    <span class="text-danger" v-if="errors.msg" >{{ errors.msg[0] }}</span>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Send Message</button>
                </div>
            </form>

            </div>
        </div>
        </div>
    </div>
</template>

<script>

    export default {
        props: ['receiverid', 'receivername'], 


        data() {
            return {
                form: {
                    msg:"",
                    receiverid: this.receiverid,
                },
                errors: {},
                succMessage: {},
            }
        },

        methods:{
            sendMsg(){
                // alert(this.form.msg)
                 axios.post('/send-message',this.form)
                 .then((res) => {
                    this.form.msg = "";
                    this.succMessage = res.data;
                    console.log(res.data);
                 }).catch((err) => {
                    this.errors = err.response.data.errors;
                 })
            }
        } 
    }

</script>