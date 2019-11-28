<template>
    <ul class="chat">
        <li class="clearfix" v-for="message in messages" :key="message.id">
            <div class="chat-body clearfix" v-if="message.user.id==active_friend.id || message.user.id==user.id" v-bind:class="{'left':(message.user.id==active_friend.id)}" >
                <p>
                    {{ message.message }}
                </p>
                <!-- <time>{{ message.created_at }}</time> -->
            </div>
        </li>
    </ul>
</template>

<script>
  export default {
    props: ['messages','active_friend','user'],
    created(){
        this.fetchMessages(this.active_friend.id);
    },
    updated(){
        console.log("updated")
        let a = document.getElementById("messages-container");
        a.scrollTop=a.scrollHeight;
    },
    methods:{
        fetchMessages(friend_id) {
            axios.get('/messages/'+friend_id).then(response => {
                console.log(response.data);               
                this.$emit('messages_fetched', response.data);
            });
        }
    },
  };
</script>