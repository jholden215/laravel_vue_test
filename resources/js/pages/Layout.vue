<template>
    <div class="container">
      <div class="card">
        <div class="card-header">
            <h2>Team <button data-toggle="modal" data-target="#addNew" @click="openModalWindow" class="btn btn-info btn-sm float-right">Add New</button></h2>
        </div>
        <div class="card-body">
         <table class="table table-hover" id="datatbl">
                  <tbody>
                    <tr>
                        <th>SNo.</th>
                        <th>Name</th>
                        <th>Action</th>
                  </tr> 
                  <tr v-for="(team,index) in teamList" :key="team.id">
                    <td>{{ index+1 }}</td>
                    <td>{{ team.name }}</td>
                    <th><button @click="goToTeam(team.id)" class="btn btn-info btn-sm">View</button></th>
                  </tr>
                </tbody>
          </table>
        </div>
      </div>
      <div class="modal" id="myModal">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Add New Team</h4>
              <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <form @submit.prevent="createTeam()">
            <div class="modal-body">
              <div class="row">
                <div class="col-sm-12">
                  <div class="form-group">
                    <label>Enter Team Name</label>
                    <input v-model="form.name" type="text" class="form-control" placeholder="Enter Team Name"   />
                  </div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button  type="submit" class="btn btn-info" >Add</button>
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
                teamList: {},
                form: new Form({
                    name : ''
                })
            }
        },
        methods: {
            loadTeam() {
              axios.get("api/get-team",{
              headers: {
                'Authorization': 'ABC123TOKEN'
              }}).then( data =>{
                this.teamList = data.data.data;
              });
            },
            goToTeam(id){;
                this.$router.push('/view-players/'+id);
            },
            openModalWindow(){
              $('#myModal').modal('show');
            },
            createTeam(){ 
              if(this.form.name=='') {
                  Toast.fire({
                          icon: 'warning',
                          title: 'Please Enter Team Name'
                        })
              } else {
                 this.form.post('api/add-team',{
                  headers: {
                    'Authorization': 'ABC123TOKEN'
                  }})
                    .then(() => {
                            Toast.fire({
                              icon: 'success',
                              title: 'Team Added successfully'
                            })
                            this.loadTeam();
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
            this.loadTeam();
        }
    }
</script>