
const checkList = document.querySelector('.check-list');
const sendAll = document.querySelector('.send-all');
const sendPHP = document.querySelector('#submit-php');
const successMessage = document.querySelector('.success-msg');
const rm1Form = document.querySelector('.rm1-47-form');
const rm2Form = document.querySelector('.rm2-47-form');
const rm3Form = document.querySelector('.rm3-47-form');
const rm4Form = document.querySelector('.rm4-47-form');
const rm5Form = document.querySelector('.rm5-47-form');
const rm6Form = document.querySelector('.rm6-47-form');

// an array to hold our state
let readings = [];

//stop the form from submitting
function handleSubmit(e) {
  e.preventDefault();
  
  //grab the value from the input field
  const userInput = e.currentTarget.rmReading.value;
  const room = e.target.name;
  const id = e.currentTarget.className;
  

  // this data will be put in state
  const reading = {
    room: room,
    userInput: userInput,
    id: id,
  };
  
  // push the readings to state
  readings.push(reading);

  // hide the input
  this.classList.add('hide');
  
  //create a custom event that will dispatch if other parts of the code also need it
  checkList.dispatchEvent(new CustomEvent('readingsUpdated')); 
}

// this function takes the data that is stored in state and renders it out in list form
function displayReadings() {
  const html = readings.map(reading => {
    return `<li>
      <em>${reading.room}:</em> 
      <strong>${reading.userInput}</strong>
      <button value='${reading.id}' >edit</button>
      </li>`
  }).join('');
  
  checkList.innerHTML = html;

  if (readings.length == 6) {
    sendAll.classList.remove('hide');
  }

}

// when editing already entered data I want to delete this entry form state and then redisplay the input field
function handleEdit(id) {
  const unhideForm = document.querySelector(`.${id}`);
  readings = readings.filter(reading => reading.id != id);
  checkList.dispatchEvent(new CustomEvent('readingsUpdated'));
  unhideForm.classList.remove('hide');

  if (readings.length < 6) {
    sendAll.classList.add('hide');
  }
}

function successAddToDB() {
  sendAll.classList.add('hide');
  checkList.classList.add('hide');
  successMessage.classList.remove('hide');
}

function handlePostData() {

  // 'http://thrive-real.local/wp-content/themes/hello-elementor/new.php'

  fetch( phpLink, {
    method: "POST",
    headers: {
      'Content-Type': 'application/JSON'
    },
    body: JSON.stringify(readings),
  })
  .then(result => {
    if(result.ok == true) {
      successAddToDB();
    }
  });

}

rm1Form.addEventListener('submit', handleSubmit);
rm2Form.addEventListener('submit', handleSubmit);
rm3Form.addEventListener('submit', handleSubmit);
rm4Form.addEventListener('submit', handleSubmit);
rm5Form.addEventListener('submit', handleSubmit);
rm6Form.addEventListener('submit', handleSubmit);
sendPHP.addEventListener('click', handlePostData);
checkList.addEventListener('readingsUpdated', displayReadings);

// listen for the click on the list but only run a function on the condition that the css class in the target matches button
checkList.addEventListener('click', function(e) {
  if(e.target.matches('button')) {
    handleEdit(e.target.value);
  }
});

//