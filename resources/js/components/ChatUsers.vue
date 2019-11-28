<template>
    <ul class="chat-users">
        <li class="left clearfix"
            v-for="friend in friends"
            :key="friend.id"
        >
            <div>
                {{friend.name}}
            </div>
        </li>
    </ul>
</template>

<script>
    export default {
        props: ['friends'],        
    }
</script>