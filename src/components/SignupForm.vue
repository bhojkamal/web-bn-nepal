<template>
  <div :class="theme" id="myId" :data-name="myname">
  <form @submit.prevent="handleSubmit">
    <label for="email">Email:</label>
    <input type="email" required v-model="email" />
    <label for="password">Password:</label>
    <input type="password" required v-model="password" />
    <div v-if="passwordError" class="error"> {{ passwordError }} </div>
    <label for="role">Role:</label>
    <select name="role" id="role" v-model="role">
      <option value="developer">Web developer</option>
      <option value="designer">Web Designer</option>
      <option value="administrator">Administrator</option>
    </select>

    <label>Skills:</label>
    <input type="text" v-model="tempSkill" @keyup.alt="addSkill" />
    <div>
      <div v-for="skill in skills" :key="skill" class="pill">
        <span @click="deleteSkill(skill)">{{ skill }}</span>
      </div>
      <br />

      <input type="checkbox" required v-model="terms" />
      <label> Accept terms and conditions </label>
    </div>

    <div class="submit">
      <button>Create an account</button>
    </div>
    <p>
      hello world <span @click="copy" style="border:1px solid black"> Hello Nepal click to copy this text </span>
    </p>

  </form>
  <p>Email: {{ email }}</p> <!-- two way binding featuere -->
  <p>Password: {{ password }}</p>
  <p>Role: {{ role }}</p>
  <p>Terms: {{ terms }}</p>
  <!-- <p>names: {{ names }} </p> -->
  </div>
   <div>
    <ul class="test-list" v-for="user in usersList" :key="user.id">
      <li class="test-list--item">
        <strong>{{ user.name }}</strong> <br>
        {{ user.email }} <br>
        {{ user.website }}
      </li>
    </ul>
  </div>
</template>

<script>
// Inject new dom element
  const tag = document.createElement("p"); // <p></p>
  const text = document.createTextNode("TEST TEXT"); 
  tag.appendChild(text); // <p>TEST TEXT</p>
  const element = document.getElementsByTagName("div")[0];
  element.appendChild(tag); // <div> <p>TEST TEXT</p> </div>

  import axios from "axios";

export default {
  data() {
    return {
      email: "",
      password: "",
      role: "designer",
      terms: true,
      // names: [],
      tempSkill: "",
      skills: [],
      passwordError: '',
      theme:'my-theme', // Change the class name of any dom elements
      myname:'Kamal kunwar', // Get datasets from dom elements
      usersList: [],
      copied:'',
    };
  },
  methods: {
    addSkill(e) {
      if (e.key === "," && this.tempSkill) {
        if (!this.skills.includes(this.tempSkill)) {
          this.skills.push(this.tempSkill);
        }
        this.tempSkill = "";
      }
    },
    deleteSkill(skill) {
      this.skills = this.skills.filter((item) => {
        return skill !== item;
      });
    },
    handleSubmit() {
      // console.log('form sumitted')
      this.passwordError = this.password.length> 5 ? '' : 'Password must be 6 charater long'
      if(!this.passwordError) {
        console.log('email', this.email) // from input
        console.log('password', this.password) // from input
        console.log('role', this.role) // dropdown 
        console.log('skills', this.skills) // with alt key. 
        console.log('terms accepted', this.terms) // check box
      }
    },
    copy(){
      // const span = document.querySelector("span");
      this.copied = document.execCommand("copy");
      console.log(this.copied)
    }
  },
  mounted () {
    // Get datasets from dom elements
    console.log(this.myname)
    // Make both ajax and get request using axios
    axios.get("https://jsonplaceholder.typicode.com/users")
      .then(res => {
        this.usersList = res.data;
        console.log(this.usersList)
      })
      .catch(error => {
        console.log(error)
         // Manage errors if found any
      })
  }
};

// to copy the text inside in span element in vanilla js.

/* const span = document.querySelector("span");

span.onclick = function() {
  document.execCommand("copy");
}

span.addEventListener("copy", function(event) {
  event.preventDefault();
  if (event.clipboardData) {
    event.clipboardData.setData("text/plain", span.textContent);
    console.log(event.clipboardData.getData("text"))
  }
}); */

</script>

<style>
.my-theme {
  background-color:lightslategray; /* Change the class name of any dom elements */
}
form {
  max-width: 420px;
  margin: 30px auto;
  background: white;
  text-align: left;
  padding: 40px;
  border-radius: 10px;
}
label {
  color: #aaa;
  display: inline-block;
  margin: 1.5rem 0 15px;
  font-size: 0.6rem;
  text-transform: uppercase;
  letter-spacing: 1px;
  font-weight: bold;
}
input,
select {
  display: block;
  padding: 0.8rem 0.28rem;
  width: 100%;
  box-sizing: border-box;
  border: none;
  border-bottom: 1px solid #ddd;
  color: #555;
}
input[type="checkbox"] {
  display: inline-block;
  width: 1rem;
  margin: 0 10px 0 0;
  position: relative;
  top: 2px;
}
.pill {
  display: inline-block;
  margin: 1.1px 100x 0 0;
  padding: 6px 12px;
  background: #eee;
  border-radius: 1.25rem;
  font-size: 0.9rem;
  letter-spacing: 1px;
  font-weight: bold;
  color: #777;
  cursor: pointer;
}
button{
  padding:10px;
  margin:5px auto;
  background: darkblue;
  color:white;
  border-radius: 20px;
}
div.submit {
  text-align:center;
}
.error {
  color: red;
  font-weight: bold;
  padding:5px;

}

ul {
  margin: 0 auto;
  width: 300px;
  text-align: left;  
}

li {
  display: block;
  margin-bottom: 10px;
  border: 1px solid #ccc;
  padding: 15px;
}
</style>
