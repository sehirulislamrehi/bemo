<template>
     <div id="app">
          <div class="loading" ref="loading">&#8230;</div>
          <section class="main-section">
               <div class="container">

                    <!-- add new board start -->
                    <div class="add-new-board">
                         <p>Welcome back mr. {{ this.visitor.name }}. <span id="logout" @click="logout">Click here for logout</span></p>
                         <input type="text" placeholder="Enter a board name" v-model="board_name" id="create-board">
                         <button @click="addBoard">Add new board</button>
                    </div>
                    <!-- add new board end -->

                    <draggable v-model="boards" class="board-list" group="board" @start="drag=true" @end="drag=true" @change="log">

                         <!-- single board start -->
                         <div class="single-board"  v-for="item in boards" :key="item.id">

                              <div class="board-information">
                                   <p>{{ item.name }}</p>
                                   <i class="fas fa-edit" @click="editBoard($event)"></i>

                                   <!-- edit board popup start -->
                                   <div class="board-edit-popup" >
                                        <div class="container">
                                             <h3>Edit board</h3>
                                             <div class="form-group">
                                                  <input type="text" class="form-control" :value="item.name">
                                                  <button class="edit-board-value" @click="updateBoard($event,item)">Update</button>
                                             </div>
                                             <button class="close-board-edit-popup" @click="closeBoardEditPopup($event)">Close</button>
                                        </div>
                                   </div>
                                   <!-- edit board popup end -->

                              </div>

                              <draggable v-model="item.card" group="card" @start="drag=true" @end="drag=true" @change="log2(item.card, item.id)">

                                   <!-- single card start -->
                                   <div class="single-card" v-for="card in item.card" :key="card.id">
                                        <i class="fas fa-trash" @click="deleteCard(item,card)"></i>
                                        <i class="fas fa-edit" @click="editCard($event)"></i>

                                        <!-- edit card popup start -->
                                        <div class="card-edit-popup" >
                                             <div class="container">
                                                  <h3>Edit Card</h3>
                                                  <div class="form-group">
                                                       <label>Name</label>
                                                       <input type="text" class="form-control" :value="card.name">
                                                  </div>
                                                  <div class="form-group">
                                                       <label>Description</label>
                                                       <input type="text" class="form-control" :value="card.description">
                                                  </div>
                                                  <div class="form-group">
                                                       <button class="edit-card-value" @click="editCardData($event,card,item)" >Update</button>
                                                  </div>
                                                  <button class="close-card-edit-popup" @click="closeCardEditPopup($event)">Close</button>
                                             </div>
                                        </div>
                                        <!-- edit card popup end -->

                                        <h3>{{ card.name }}</h3>
                                        <p>{{ card.description }}</p>
                                   </div>
                                   <!-- single card end -->

                              </draggable>

                              <div class="delete-board">
                                   <input type="text" placeholder="Enter Card name">
                                   <button @click="addCard(item, $event)" class="add-card">Add Card</button>
                              </div>
                              <div class="delete-board">
                                   <button @click="deleteBoard(item)">Delete Board</button>
                              </div>

                         </div>
                         <!-- single board end -->

                    </draggable>

               </div>
          </section>
     </div>
</template>

<style scoped>
     @import url("/css/loader.css");
     @import url("/css/index.css");
</style>

<script>
     import axios from "axios"
     import draggable from 'vuedraggable'

     export default {
          components: {
               draggable
          },
          data() {
               return {
                    url: this.$apiURL,
                    visitor: [],
                    board_name: "",
                    boards: [],
               }
          },
          created() {
               this.initialize()
          },
          methods: {
               initialize() {

                    //token validation start
                    let token = localStorage.getItem("token")
                    let verification_url = this.$apiURL + "visitor/verification/" + token

                    if( token ){

                         axios.get(`${verification_url}`)
                         .then(res => {
                              let data = res.data 
                              if( data.status == "success" ){
                                   this.visitor = data.data.visitor
                                   localStorage.setItem('token', data.data.token)

                                   //get all board start
                                   let get_board_url = this.$apiURL + "get-board/" + token
                                   axios.get(`${get_board_url}`)
                                   .then(res => {
                                        let data = res.data

                                        if( data.status == "success" ){
                                             this.boards = data.data
                                        }
                                        else{
                                             this.boards = [];
                                             alert(data.message)
                                        }
                                   })
                                   .catch( error => {
                                        console.log(error)
                                   })
                                   //get all board end

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
                    //token validation end


                    
                    
               },
               logout(){
                    localStorage.removeItem('token')
                    this.$router
                    .push("/")
                    .then()
               },
               addBoard(){

                    let board_name = this.board_name
                    
                    if( board_name ){
                         let token = localStorage.getItem("token")
                         let verification_url = this.$apiURL + "visitor/verification/" + token

                         if( token ){
                              this.$refs.loading.style.display = "block"

                              axios.get(`${verification_url}`)
                              .then(res => {
                                   let data = res.data 
                                   if( data.status == "success" ){
                                        this.visitor = data.data.visitor
                                        localStorage.setItem('token', data.data.token)

                                        //create board start
                                        let form = new FormData()
                                        form.append('board_name', this.board_name)
                                        form.append('token', token)

                                        let create_board_url = this.url + "create-board"

                                        axios.post(`${create_board_url}`, form)
                                        .then( res =>  {
                                             this.$refs.loading.style.display = "none"
                                             this.boards.push(res.data.data)
                                             
                                        })
                                        .catch( error => {
                                             this.$refs.loading.style.display = "none"
                                             console.log(error)
                                        })
                                        //create board end

                                   }
                                   else{
                                        this.$refs.loading.style.display = "none"
                                        alert(data.message)
                                        localStorage.removeItem('token')
                                        this.$router
                                        .push("/")
                                        .then()
                                   }
                              })
                              .catch( error => {
                                   this.$refs.loading.style.display = "none"
                                   alert(error)
                              })
                         }
                         else{
                              this.$router
                              .push("/")
                              .then()
                         }
                    }
                    else{
                         alert("Please enter a board name")
                    }

               },
               deleteBoard(board) {

                    if( confirm("Are you sure want to delete this board?") == true ){
                         let token = localStorage.getItem("token")
                         let verification_url = this.$apiURL + "visitor/verification/" + token

                         if( token ){
                              this.$refs.loading.style.display = "block"

                              axios.get(`${verification_url}`)
                              .then(res => {
                                   let data = res.data 
                                   if( data.status == "success" ){
                                        this.visitor = data.data.visitor
                                        localStorage.setItem('token', data.data.token)

                                        //delete board start
                                        let id = board.id;
                                        let delete_board_url = this.$apiURL + "delete-board/" + id

                                        axios
                                        .get(`${delete_board_url}`)
                                        .then(res => {
                                             this.$refs.loading.style.display = "none"
                                             if( res.data.status == "success" ){
                                                  this.boards.filter((value, index) => {
                                                       if (id == value.id) {
                                                            return this.boards.splice(index, 1);
                                                       }
                                                  });
                                             }
                                             else{
                                                  alert(res.data.message)
                                             }
                                             
                                        })
                                        .catch(res => {
                                             this.$refs.loading.style.display = "none"
                                             console.log(res)
                                        });
                                        //delete board end

                                   }
                                   else{
                                        this.$refs.loading.style.display = "none"
                                        alert(data.message)
                                        localStorage.removeItem('token')
                                        this.$router
                                        .push("/")
                                        .then()
                                   }
                              })
                              .catch( error => {
                                   this.$refs.loading.style.display = "none"
                                   alert(error)
                              })
                         }
                         else{
                              this.$router
                              .push("/")
                              .then()
                         }  
                    }

               },
               log(){
                    let token = localStorage.getItem("token")
                    let verification_url = this.$apiURL + "visitor/verification/" + token

                    if( token ){
                         // this.$refs.loading.style.display = "block"

                         axios.get(`${verification_url}`)
                         .then(res => {
                              let data = res.data 
                              if( data.status == "success" ){
                                   this.visitor = data.data.visitor
                                   localStorage.setItem('token', data.data.token)

                                   //board sorting start
                                   let board = this.boards;
                                   let board_sorting_url = this.$apiURL + "board-sorting/" + token

                                   let formData = new FormData();
                                   formData.append("boards", JSON.stringify(board))

                                   axios.post(`${board_sorting_url}`, formData)
                                   .then(res => {
                                        console.log(res)
                                        // this.$refs.loading.style.display = "none"
                                   })
                                   .catch(res => {
                                        console.log(res)
                                        // this.$refs.loading.style.display = "none"
                                   });
                                   //board sorting end

                              }
                              else{
                                   // this.$refs.loading.style.display = "none"
                                   alert(data.message)
                                   localStorage.removeItem('token')
                                   this.$router
                                   .push("/")
                                   .then()
                              }
                         })
                         .catch( error => {
                              // this.$refs.loading.style.display = "none"
                              alert(error)
                         })
                    }
                    else{
                         this.$router
                         .push("/")
                         .then()
                    }
               },
               log2(cards, item_id){
                    let token = localStorage.getItem("token")
                    let verification_url = this.$apiURL + "visitor/verification/" + token

                    if( token ){
                         // this.$refs.loading.style.display = "block"

                         axios.get(`${verification_url}`)
                         .then(res => {
                              let data = res.data 
                              if( data.status == "success" ){
                                   this.visitor = data.data.visitor
                                   localStorage.setItem('token', data.data.token)

                                   //card sorting start
                                   let card_sorting_url = this.$apiURL + "card-sorting/" + token

                                   let formData = new FormData();
                                   formData.append("cards", JSON.stringify(cards))
                                   formData.append("item_id", item_id)

                                   axios.post(`${card_sorting_url}`, formData)
                                   .then(res => {
                                        console.log(res)
                                        // this.$refs.loading.style.display = "none"
                                   })
                                   .catch(res => {
                                        console.log(res)
                                        // this.$refs.loading.style.display = "none"
                                   });
                                   //card sorting end

                              }
                              else{
                                   // this.$refs.loading.style.display = "none"
                                   alert(data.message)
                                   localStorage.removeItem('token')
                                   this.$router
                                   .push("/")
                                   .then()
                              }
                         })
                         .catch( error => {
                              // this.$refs.loading.style.display = "none"
                              alert(error)
                         })
                    }
                    else{
                         this.$router
                         .push("/")
                         .then()
                    }
               },
               addCard(board, event){

                    let token = localStorage.getItem("token")
                    let verification_url = this.$apiURL + "visitor/verification/" + token

                    if( token ){
                         this.$refs.loading.style.display = "block"

                         axios.get(`${verification_url}`)
                         .then(res => {
                              let data = res.data 
                              if( data.status == "success" ){
                                   this.visitor = data.data.visitor
                                   localStorage.setItem('token', data.data.token)

                                   //add card start
                                   let id = board.id;
                                   let add_card_url = this.$apiURL + "add-card/" + id
                                   let card_name = event.target.previousElementSibling.value;

                                   if( card_name ){

                                        let formData = new FormData();

                                        formData.append('card_name', card_name)

                                        axios
                                        .post(`${add_card_url}`, formData)
                                        .then(res => {
                                             this.$refs.loading.style.display = "none"
                                             let data = res.data.data;
                                             board.card.push(data)
                                        })
                                        .catch(res => {
                                             this.$refs.loading.style.display = "none"
                                             console.log(res)
                                        });
                                   }
                                   else{
                                        this.$refs.loading.style.display = "none"
                                        alert("Please enter a card name");
                                   }
                                   
                                   //add card end

                              }
                              else{
                                   this.$refs.loading.style.display = "none"
                                   alert(data.message)
                                   localStorage.removeItem('token')
                                   this.$router
                                   .push("/")
                                   .then()
                              }
                         })
                         .catch( error => {
                              this.$refs.loading.style.display = "none"
                              alert(error)
                         })
                    }
                    else{
                         this.$router
                         .push("/")
                         .then()
                    }
               },
               deleteCard(board,card){

                    if( confirm("Are you sure want to delete this card?") == true ){
                         let token = localStorage.getItem("token")
                         let verification_url = this.$apiURL + "visitor/verification/" + token

                         if( token ){
                              this.$refs.loading.style.display = "block"

                              axios.get(`${verification_url}`)
                              .then(res => {
                                   let data = res.data 
                                   if( data.status == "success" ){
                                        this.visitor = data.data.visitor
                                        localStorage.setItem('token', data.data.token)

                                        //delete card start
                                        let id = card.id;
                                        let delete_card_url = this.$apiURL + "delete-card/" + id

                                        axios
                                        .get(`${delete_card_url}`)
                                        .then(res => {
                                             this.$refs.loading.style.display = "none"
                                             
                                             if( res.data.status == "success" ){
                                                  board.card.filter((value, index) => {
                                                       if (card.id == value.id) {
                                                            return board.card.splice(index, 1);
                                                       }
                                                  });
                                             }
                                             else{
                                                  alert(res.data.message)
                                             }
                                             
                                        })
                                        .catch(res => {
                                             this.$refs.loading.style.display = "none"
                                             console.log(res)
                                        });
                                        //delete card end

                                   }
                                   else{
                                        this.$refs.loading.style.display = "none"
                                        alert(data.message)
                                        localStorage.removeItem('token')
                                        this.$router
                                        .push("/")
                                        .then()
                                   }
                              })
                              .catch( error => {
                                   this.$refs.loading.style.display = "none"
                                   alert(error)
                              })
                         }
                         else{
                              this.$router
                              .push("/")
                              .then()
                         }  
                    }
               },
               editBoard(event){
                    event.target.nextElementSibling.style.display = "block"
               },
               closeBoardEditPopup(event){
                    event.target.parentElement.parentElement.style.display = "none"
               },
               updateBoard(event, board){
                    
                    let board_name = event.target.previousElementSibling.value;

                    if( board_name ){

                         let token = localStorage.getItem("token")
                         let verification_url = this.$apiURL + "visitor/verification/" + token

                         if( token ){
                              this.$refs.loading.style.display = "block"

                              axios.get(`${verification_url}`)
                              .then(res => {
                                   let data = res.data 
                                   if( data.status == "success" ){
                                        this.visitor = data.data.visitor
                                        localStorage.setItem('token', data.data.token)

                                        //edit board start
                                        let id = board.id;
                                        let form = new FormData()
                                        form.append('board_name', board_name)
                                        form.append('board_id', id)

                                        let edit_board_url = this.url + "edit-board"

                                        axios.post(`${edit_board_url}`, form)
                                        .then( res =>  {
                                             this.$refs.loading.style.display = "none"

                                             if( res.data.status == "success" ){
                                                  alert(res.data.message)
                                                  this.boards.filter((value, index) => {
                                                       if (board.id == value.id) {
                                                            return this.boards.splice(index, 1,res.data.data);
                                                       }
                                                  });
                                             }
                                             else{
                                                  alert(res.data.message)
                                             }
                                             
                                        })
                                        .catch( error => {
                                             this.$refs.loading.style.display = "none"
                                             console.log(error)
                                        })
                                        //edit board end

                                   }
                                   else{
                                        this.$refs.loading.style.display = "none"
                                        alert(data.message)
                                        localStorage.removeItem('token')
                                        this.$router
                                        .push("/")
                                        .then()
                                   }
                              })
                              .catch( error => {
                                   this.$refs.loading.style.display = "none"
                                   alert(error)
                              })
                         }
                         else{
                              this.$router
                              .push("/")
                              .then()
                         }
                    }
                    else{
                         alert("Enter a board name.")
                    }
                    
               },
               editCard(event){
                    event.target.nextElementSibling.style.display = "block"
               },
               closeCardEditPopup(event){
                    event.target.parentElement.parentElement.style.display = "none"
               },
               editCardData(event, card, board){
                    let description = event.target.parentElement.previousElementSibling.childNodes[1].value
                    let name = event.target.parentElement.previousElementSibling.previousElementSibling.childNodes[1].value

                    if( name ){

                         let token = localStorage.getItem("token")
                         let verification_url = this.$apiURL + "visitor/verification/" + token

                         if( token ){
                              this.$refs.loading.style.display = "block"

                              axios.get(`${verification_url}`)
                              .then(res => {
                                   let data = res.data 
                                   if( data.status == "success" ){
                                        this.visitor = data.data.visitor
                                        localStorage.setItem('token', data.data.token)

                                        //edit card start
                                        let id = card.id;
                                        let form = new FormData()
                                        form.append('id', id)
                                        form.append('name', name)
                                        form.append('description', description)

                                        let edit_card_url = this.url + "edit-card"

                                        axios.post(`${edit_card_url}`, form)
                                        .then( res =>  {
                                             this.$refs.loading.style.display = "none"

                                             if( res.data.status == "success" ){
                                                  alert(res.data.message)
                                                  board.card.filter((value, index) => {
                                                       if (card.id == value.id) {
                                                            return board.card.splice(index, 1,res.data.data);
                                                       }
                                                  });
                                             }
                                             else{
                                                  alert(res.data.message)
                                             }
                                             
                                        })
                                        .catch( error => {
                                             this.$refs.loading.style.display = "none"
                                             console.log(error)
                                        })
                                        //edit card end

                                   }
                                   else{
                                        this.$refs.loading.style.display = "none"
                                        alert(data.message)
                                        localStorage.removeItem('token')
                                        this.$router
                                        .push("/")
                                        .then()
                                   }
                              })
                              .catch( error => {
                                   this.$refs.loading.style.display = "none"
                                   alert(error)
                              })
                         }
                         else{
                              this.$router
                              .push("/")
                              .then()
                         }
                    }
                    else{
                         alert("Please enter a card name")
                    }
                    
               }
          },
          mounted() {
               window.scrollTo(0, 0);
          }

     }
</script>