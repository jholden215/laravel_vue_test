<template>
    <div class="container">
      <div class="card">
        <div class="card-header">
            <h2>Player <button data-toggle="modal" data-target="#addNew" @click="openModalWindow" class="btn btn-info btn-sm float-right">Add New</button></h2>
        </div>
        <div class="card-body">
         <table class="table table-hover">
                  <tbody>
                    <tr>
                        <th>id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Team</th>
                        <th>Action</th>
                  </tr> 
                  <tr v-for="(player,index) in playerList" :key="player.id">
                    <td>{{ index+1 }}</td>
                    <td>{{ player.first_name }}</td>
                    <td>{{ player.last_name }}</td>
                    <td>{{ player.team_name }}</td>
                    <td>
                        <button @click="editModalWindow(player)" class="btn btn-info">Edit</button>
                    </td>
                  </tr>
                </tbody>
          </table>
        </div>
      </div>
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Player</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form  @submit.prevent="editMode ? updatePlayer() : createPlayer()">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Enter First Name</label>
                    <input v-model="form.first_name" type="text" class="form-control" placeholder="Enter First Name"   />
                  </div>
                  <div class="form-group">
                    <label>Enter Last Name</label>
                    <input v-model="form.last_name" type="text" class="form-control" placeholder="Enter Last Name"   />
                  </div>
                   <div class="form-group">
                        <select name="team"  v-model="form.team" id="team" class="form-control">
                            <option value="">Select Team</option>
                            <option  v-for="(team) in teamList" :key="team.id"  :selected="team.id == 25"  v-bind:value="team.id">{{team.name}}</option>
                        </select>
                    </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button v-show="!editMode" type="submit" class="btn btn-info" >Add</button>
              <button v-show="editMode" type="submit" class="btn btn-info">Update</button>
              <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>

</template>
<script>
export default {
        data() {
            return {
                editMode: false,
                playerList: {},
                teamList: {},
                form: new Form({
                    first_name : '',
                    last_name : '', 
                    team:'',
                    id:'',
                })
            }
        },
        methods: {
            loadplayer() {
                    axios.get("api/get-player",{
                  headers: {
                    'Authorization': 'ABC123TOKEN'
                  }}).then( data =>{
                    this.playerList = data.data.data;
                });
            },
            loadTeam() {
                    axios.get("api/get-team",{
                  headers: {
                    'Authorization': 'ABC123TOKEN'
                  }}).then( data =>{
                    this.teamList = data.data.data;
                });
            },
            openModalWindow(){
              this.form.team='';
              $('#myModal').modal('show');
            },
            editModalWindow(user){
                this.form.clear();
                this.editMode = true
                this.form.reset();
                console.log(user);
                $('#myModal').modal('show');
                this.form.fill(user)
            },
            updatePlayer(){
                if(this.form.first_name=='') {
                  Toast.fire({
                          icon: 'warning',
                          title: 'Please Enter Player First Name'
                        })
              }
              
              else if(this.form.last_name=='') {
                  Toast.fire({
                          icon: 'warning',
                          title: 'Please Enter Player Last Name'
                        })
              } else if(this.form.team=='') {
                  Toast.fire({
                          icon: 'warning',
                          title: 'Please Select Team'
                        })
              } else {
                 this.form.post('api/edit-player',{
                  headers: {
                    'Authorization': 'ABC123TOKEN'
                  }})
                    .then(() => {
                            Toast.fire({
                              icon: 'success',
                              title: 'Player successfully Updated'
                            })
                            this.loadplayer();
                            this.form.reset();
                            $('#myModal').modal('hide');

                    })
                    .catch(() => {
                      console.log("Error......")
                    })

              }
            },
            createPlayer(){ 
              if(this.form.first_name=='') {
                  Toast.fire({
                          icon: 'warning',
                          title: 'Please Enter Player First Name'
                        })
              }
              
              else if(this.form.last_name=='') {
                  Toast.fire({
                          icon: 'warning',
                          title: 'Please Enter Player Last Name'
                        })
              } else if(this.form.team=='') {
                  Toast.fire({
                          icon: 'warning',
                          title: 'Please Select Team'
                        })
              } else {
                 this.form.post('api/add-player',{
                  headers: {
                    'Authorization': 'ABC123TOKEN'
                  }})
                    .then(() => {
                            Toast.fire({
                              icon: 'success',
                              title: 'Player successfully Added'
                            })
                            this.loadplayer();
                            this.form.reset();
                            $('#myModal').modal('hide');

                    })
                    .catch(() => {
                      console.log("Error......")
                    })
              }
            }
        },
        created() { 
            this.loadplayer();
            this.loadTeam();
        }
    }
</script>