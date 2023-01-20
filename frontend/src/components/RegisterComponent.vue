<template>
     <div id="app">
          <div class="loading" ref="loading">&#8230;</div>
          <section class="login-section">
               <div class="container">
                    <div class="header">
                         <h3>Register Here</h3>
                    </div>
                    <div class="body">
                         <div class="form-group">
                              <label>Name</label>
                              <input type="text" v-model="name" class="form-control">
                              <small v-if="errors.name" class="text-red">{{ errors.name[0] }}</small>
                         </div>
                         <div class="form-group">
                              <label>Email</label>
                              <input type="email" v-model="email" class="form-control">
                              <small v-if="errors.email" class="text-red">{{ errors.email[0] }}</small>
                         </div>
                         <div class="form-group">
                              <label>Password</label>
                              <input type="password" v-model="password" class="form-control">
                              <small v-if="errors.password" class="text-red">{{ errors.password[0] }}</small>
                         </div>
                         <div class="form-group">
                              <label>Confirm Password</label>
                              <input type="password" v-model="password_confirmation" class="form-control">
                              <small v-if="errors.password_confirmation" class="text-red">{{ errors.password_confirmation[0] }}</small>
                         </div>
                         <div class="form-group button">
                              <button type="button" @click="doRegister">Register</button>
                         </div>
                         <div class="form-group">
                              <p>Already registered? Go to <router-link to="/">login</router-link> page</p>
                         </div>
                    </div>
               </div>
          </section>
     </div>
</template>

<style scoped>
     @import url("/css/login.css");
</style>

<script>
     import axios from "axios"

     export default {
          components: {},
          data() {
               return {
                    name: "",
                    email: "",
                    password: "",
                    password_confirmation: "",
                    errors: [],
                    url: this.$apiURL,
               }
          },
          created() {
               this.initialize()
          },

          methods: {
               initialize() {

               },
               doRegister() {

                    this.$refs.loading.style.display = "block"

                    this.errors = []

                    let form = new FormData()
                    form.append('name', this.name)
                    form.append('email', this.email)
                    form.append('password', this.password)
                    form.append('password_confirmation', this.password_confirmation)

                    let registration_url = this.url + "visitor/registration"

                    axios.post(`${registration_url}`, form)
                    .then(res => {

                         this.$refs.loading.style.display = "none"

                         let data = res.data 
                         if( data.status == "success" ){
                              alert("Registration successfully done. Please click ok and login.")
                              this.$router
                              .push("/")
                              .then()
                         }
                         else{
                              alert(data.message)
                         }
                    })
                    .catch(error => {
                         this.$refs.loading.style.display = "none"

                         let singleError = error.response.data.error
                         this.errors = {
                              ...singleError
                         }
                    })
               }
          },
          mounted() {
               window.scrollTo(0, 0);
          }

     }
</script>