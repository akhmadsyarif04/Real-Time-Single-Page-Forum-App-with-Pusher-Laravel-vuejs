<template>

  <div class="text-xs-center">
    <v-menu offset-y>
      <template v-slot:activator="{ on }">
        <v-btn icon v-on="on">
          <v-icon :color="color" >add_alert</v-icon> {{unreadCount}}
        </v-btn>
      </template>
      <v-list>

        <v-list-tile
          v-for="item in unread"
          :key="item.id"
        >
        <router-link :to="item.path">
          <v-list-tile-title @click="readNotif(item)">{{item.question}}</v-list-tile-title>
        </router-link>
        </v-list-tile>

        <v-divider></v-divider>

        <v-list-tile
          v-for="item in read"
          :key="item.id"
        >
          <v-list-tile-title>{{item.question}}</v-list-tile-title>
        </v-list-tile>


      </v-list>
    </v-menu>
  </div>
</template>

<script>
export default {
  data(){
    return{
      read : {},
      unread : {},
      unreadCount : 0,
      sound: "http://soundbible.com/mp3/glass_ping-Go445-1207030150.mp3"
    }
  },
  created() {
    if (User.loggedIn()) {
      this.getNotifications()
    }
    // pusher untuk reply
    Echo.private('App.User.' + User.id())
        .notification((notification) => {
            // console.log(notification.type);
            this.playSound()
            this.unread.unshift(notification)
            this.unreadCount++
        });
  },
  methods:{
    playSound(){
      let alert = new Audio(this.sound)
      const playedPromise = alert.play();
      if (playedPromise !== undefined) {
          playedPromise.then(_ => {
            // Autoplay started!
            alert.play();
          }).catch(error => {
            // Autoplay was prevented.
            // Show a "Play" button so that user can start playback.
          });
        }

    },
    getNotifications(){
      axios.post('/api/notifications')
      .then(res => {
        this.read = res.data.read
        this.unread = res.data.unread
        this.unreadCount = res.data.unread.length
      })
      .catch(error => Exception.handle(error))
    },
    readNotif(notification){
      console.log(notification.id)
      axios.post('/api/markAsRead', {id:notification.id})
      .then(res =>  {
        this.unread.splice(notification,1)
        this.read.push(notification)
        this.unreadCount --
      })
    }
  },
  computed:{
    color(){
      return this.unreadCount > 0 ? 'red' : 'red lighten-4'
    }

  }
}
</script>

<style lang="css" scoped>
</style>
