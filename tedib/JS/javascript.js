// json data retrival with fetch api
// define app root
const container = document.getElementById('root')

// define nav button
const usersBtn = document.getElementById('index');

// define url
const url = 'http://localhost:8888/tedib/PHP/API/Entry.php';

fetchAll();










// DELETE CHAPTER *******

function remove(id) {
    
    const data = {"id": id};
    
    // Default options are marked with *
    fetch(url, {
    method: 'DELETE', // GET, POST, PUT, *DELETE, etc.
    mode: 'cors', // no-cors, *cors, same-origin
    cache: 'no-cache', // *default, no-cache, reload, force-cache, only-if-cached
    credentials: 'same-origin', // include, *same-origin, omit
    headers: {
        'Content-Type': 'application/json'
    },
    redirect: 'follow', // manual, *follow, error
    referrer: 'no-referrer', // no-referrer, *client
    body: JSON.stringify(data) // body data type must match "Content-Type" header
    });
    
    container.innerHTML = "";
    fetchAll();   
}
    

// END OF DELETE CHAPTER *******







// FETCH AND UPDATE SINGLE USER CHAPTER *******

async function fetchUpdate(id){
    let newurl = url+'?id='+id;
    try {
      const response = await fetch(newurl, {
        method: 'GET', // or 'PUT'
        // body: JSON.stringify(data), // data can be `string` or {object}!
        headers: {
          'Content-Type': 'application/json'
        }
      });
      const json = await response.json();


      container.innerHTML = "";
      const form = document.createElement('form');
      const h2 = document.createElement('h2');
      const input = document.createElement('input');
      const input1 = document.createElement('input');
      const input2 = document.createElement('input');
      const updateBtn = document.createElement('button');
      form.setAttribute('method', 'PUT');
      input.setAttribute('type', 'text');
      input.value = json.username;
      input1.setAttribute('type', 'email');
      input1.value = json.email;
    //   input1.setAttribute('placeholder', 'Email');
      input2.setAttribute('type', 'text');
    //   input2.setAttribute('placeholder', 'Adgangskode');
      input2.value = json.password;
      updateBtn.setAttribute('type', 'button');
      updateBtn.setAttribute('onclick', 'update('+id+')')
  
      h2.textContent = "Brugeropdatering";
      updateBtn.textContent = "Opdater bruger";
  
      container.appendChild(form);
      
       // Append inputs to DOM
      form.appendChild(h2);
      form.appendChild(input);
      form.appendChild(input1);
      form.appendChild(input2);
      form.appendChild(updateBtn);

    } catch (error) {
      console.error('Error:', error);
    }
 

  }


function update(id) {
    
    let u = document.forms[0][0].value;
    let e = document.forms[0][1].value;
    let p = document.forms[0][2].value;


    let data = JSON.stringify({
      "id": id,
      "username": u,
      "useremail": e,
      "userpassword": p,
    });

    // n for notification
    // const n = document.createElement('section');
    // n.setAttribute('class', 'notification');
    // const m = document.querySelector('section.messages');
    // n.textContent = "Brugeren "+u+" er blevet opdateret, du bliver returneret til alle brugere.";

      if (fetch(url, {
        // mode: "no-cors",
        headers: { "Content-Type": "application/json; charset=utf-8" },
        method: 'PUT',
        body: data
      })) {
        console.log('Opdatering gik igennem!');
        // m.appendChild(n);
        setTimeout(function(){
            container.innerHTML = "";
            fetchAll();
         }, 1000);
      } else {
          console.log('Der skete en fejl!');
      }

}

// END OF FETCH AND UPDATE SINGLE USER CHAPTER *******


// FETCH ALL USERS CHAPTER *******

function fetchAll(){
    fetch(url) //fetch url

    .then((resp) => resp.json()) // use the response as json

    .then(function(data) {
    // build view here...
    //console.log(data);
    data.forEach(user => {
        // build user card

        
        const userCard = document.createElement('article');
        userCard.setAttribute('class', 'userbox');

        const h2 = document.createElement('h2');
        h2.textContent = user.email;


        const p = document.createElement('p');
        const p1 = document.createElement('p');
        const a = document.createElement('a');
        const a1 = document.createElement('a');
        const editIcon = document.createElement('i');
        const deleteIcon = document.createElement('i');

        a.setAttribute('onclick', 'fetchUpdate('+user.id+')')
        a1.setAttribute('onclick', 'remove('+user.id+')');
        editIcon.setAttribute('class', 'material-icons edit');
        editIcon.textContent = "settings_applications";
        editIcon.setAttribute('title', 'Rediger bruger');
        deleteIcon.setAttribute('class', 'material-icons delete');
        deleteIcon.textContent = "delete_sweep";
        deleteIcon.setAttribute('title', 'Slet bruger');

    // movie.description = movie.description.substring(0, 300); // Limit to 300 chars
    p.textContent = 'Brugernavn: ' + user.username; // End with an ellipses
    p1.textContent = 'Adgangskode: ' + user.password;


    // Append article to DOM
    container.appendChild(userCard);
    // append H2 and paragraph

    userCard.appendChild(h2);
    userCard.appendChild(p);
    userCard.appendChild(p1);
    userCard.appendChild(a);
    userCard.appendChild(a1);
    a.appendChild(editIcon);
    a1.appendChild(deleteIcon);


    })

    })
    // catch errors
    .catch(function() {

    console.log("uuuups");
    });
}

usersBtn.onclick = function(){
    container.innerHTML = "";
    fetchAll();
}

// END OF FETCH ALL USERS CHAPTER *******



// CREATE CHAPTER *******


// define create button
const btn = document.getElementById('createBtn')

btn.onclick = function(){
    
    container.innerHTML = "";
    const form = document.createElement('form');
    const h2 = document.createElement('h2');
    const input = document.createElement('input');
    const input1 = document.createElement('input');
    const input2 = document.createElement('input');
    const createBtn = document.createElement('button');
    form.setAttribute('method', 'PUT');
    input.setAttribute('type', 'text');
    input.setAttribute('placeholder', 'Brugernavn');
    input1.setAttribute('type', 'email');
    input1.setAttribute('placeholder', 'Email');
    input2.setAttribute('type', 'password');
    input2.setAttribute('placeholder', 'Adgangskode');
    createBtn.setAttribute('type', 'button');
    createBtn.setAttribute('onclick', 'create()')

    h2.textContent = "Brugeroprettelse";
    createBtn.textContent = "Opret ny bruger";

    container.appendChild(form);
    
     // Append inputs to DOM
     form.appendChild(h2);
    form.appendChild(input);
    form.appendChild(input1);
    form.appendChild(input2);
    form.appendChild(createBtn);
}



function create(){
let u = document.forms[0][0].value;
let e = document.forms[0][1].value;
let p = document.forms[0][2].value;
// n.textContent = "Brugeren "+u+" er blevet oprettet, du bliver returneret til alle brugere.";

let data = JSON.stringify({
  "username": u,
  "useremail": e,
  "userpassword": p,
});


if (fetch(url, {
  mode: "no-cors",
  headers: { "Content-Type": "application/json; charset=utf-8" },
  method: 'POST',
  body: data
})) {
  setTimeout(function(){
            container.innerHTML = "";
            fetchAll();
           }, 1000);
} else {
  console.error('Fejl');
}
    }


// END OF CREATE CHAPTER *******