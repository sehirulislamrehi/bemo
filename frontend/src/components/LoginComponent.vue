<template>
    <div id="app">
        <div class="loading" ref="loading">&#8230;</div>
        <section class="login-section">
            <div class="container">
                <div class="header">
                    <h3>Welcome to <span><strong>[ Kanban Board ]</strong></span></h3>
                </div>
                <div class="body">
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
                    <div class="form-group button">
                        <button type="button" @click="doLogin">Login</button>
                    </div>
                    <div class="form-group">
                        <p>Not registered yet? Go to <router-link to="/register">register</router-link> page</p>
                    </div>
                </div>
            </div>
        </section>
    </div>
</template>

<style scoped>
    @import url("/css/loader.css");
    @import url("/css/login.css");
</style>

<script>
    import axios from "axios"

    export default {
        components: {},
        data() {
            return {
                email: "",
                password: "",
                errors: [],
                url: this.$apiURL,
            }
        },
        created() {
            this.initialize()
        },

        methods: {
            initialize(){
            },
            doLogin(){
                this.errors = []

                this.$refs.loading.style.display = "block"


                let form = new FormData()
                form.append('email', this.email)
                form.append('password', this.password)

                let login_url = this.url + "visitor/signin"

                axios.post(`${login_url}`, form)
                .then( res =>  {
                    this.$refs.loading.style.display = "none"

                    let data = res.data 
                    if( data.status == "success" ){
                        localStorage.setItem('token', data.data.token)
                        this.$router
                        .push("/dashboard")
                        .then()
                    }
                    else{
                        alert(data.message)
                    }
                    
                        
                })
                .catch( error => {
                    this.$refs.loading.style.display = "none"

                    let singleError = error.response.data.error
                    this.errors = {...singleError}
                })
            }
        },
        mounted() {
            window.scrollTo(0, 0);
        }

    }
</script>