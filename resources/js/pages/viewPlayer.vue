<template>
    <div class="container">
      <div class="card">
        <div class="card-header">
            <h2>Player <router-link to="/" class="btn btn-info btn-sm float-right">Back To Team Page</router-link></h2>
        </div>
        <div class="card-body">
         <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Team</th>
                  </tr> 
                  <tr v-for="(player,index) in playerList" :key="player.id">
                    <td>{{ index+1 }}</td>
                    <td>{{ player.first_name }}</td>
                    <td>{{ player.last_name }}</td>
                    <td>{{ player.team_name }}</td>
                  </tr>
                </tbody>
          </table>
        </div>
      </div>
    </div>
</template>
<script>
export default {
   
        data() {
            return {
                playerList: {},
            }
        },
        methods: {
            
            loadplayer() {
                    axios.get("api/get-player/"+this.$route.params.id,{
              headers: {
                'Authorization': 'ABC123TOKEN'
              }}).then( data =>{
                    this.playerList = data.data.data;
                });
            },
        },
        created() { 
            this.loadplayer();
        }
    }
</script>