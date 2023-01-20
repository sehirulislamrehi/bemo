<template>
     <div id="app">
          <section class="main-section">
               <div class="container">

                    <!-- add new board start -->
                    <div class="add-new-board">
                         <p>Welcome back mr. {{ this.visitor.name }}. <span id="logout" @click="logout">Click here for logout</span></p>
                         <input type="text" placeholder="Enter a board name" id="create-board">
                         <button>Add new board</button>
                    </div>
                    <!-- add new board end -->

                    <div class="board-list">

                         <!-- single board start -->
                         <div class="single-board">

                              <div class="board-information">
                                   <p>Board Name</p>
                                   <i class="fas fa-edit"></i>
                              </div>

                              <!-- single card start -->
                              <div class="single-card">
                                   <h3>Card 1</h3>
                                   <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit...</p>
                              </div>
                              <!-- single card end -->

                              <!-- single card start -->
                              <div class="single-card">
                                   <h3>Card 1</h3>
                                   <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit...</p>
                              </div>
                              <!-- single card end -->

                              <div class="delete-board">
                                   <button>Delete Board</button>
                              </div>

                         </div>
                         <!-- single board end -->

                    </div>

               </div>
          </section>
     </div>
</template>

<style scoped>
     @import url("/css/index.css");
</style>

<script>
     import axios from "axios"

     export default {
          components: {},
          data() {
               return {
                    url: this.$apiURL,
                    visitor: []
               }
          },
          created() {
               this.initialize()
          },

          methods: {
               initialize() {

                    let token = localStorage.getItem("token")
                    let verification_url = this.$apiURL + "visitor/verification/" + token

                    if( token ){

                         axios.get(`${verification_url}`)
                         .then(res => {
                              let data = res.data 
                              if( data.status == "success" ){
                                   this.visitor = data.data.visitor
                                   localStorage.setItem('token', data.data.token)
                              }
                              else{
                                   alert(data.message)
                                   localStorage.removeItem('token')
                                   this.$router
                                   .push("/")
                                   .then()
                              }
                         })
                         .catch( error => {
                              alert(error)
                         })
                    }
                    else{
                         this.$router
                         .push("/")
                         .then()
                    }
                    
               },
               logout(){
                    localStorage.removeItem('token')
                    this.$router
                    .push("/")
                    .then()
               },
          },
          mounted() {
               window.scrollTo(0, 0);
          }

     }
</script>