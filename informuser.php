<?php
session_start();
// Redirect to login page if the user is not logged in
if (!isset($_SESSION['role'])) {
    header("Location: adminlogin.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Inform Passenger</title>

<style>
    body {
        font-family: Arial, sans-serif;
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #f0f0f0;
    }

    .popupupdate {
        background-color: #fff;
        padding: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        max-width: 400px;
        width: 100%;
        text-align: center;
    }

    .popup_title {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }

    .popup_title h2 {
        margin: 0;
        font-size: 24px;
        color: #333;
    }

    .popup_title i {
        cursor: pointer;
        font-size: 20px;
        color: #999;
    }

    .login_form p {
        margin-bottom: 15px;
    }

    .login_form select,
    .login_form input {
        width: calc(100% - 22px);
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
    }

    .login_form label {
        font-size: 16px;
        color: #555;
    }

    .btn {
        padding: 10px 20px;
        margin: 10px 0;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 16px;
        background-color: #007bff; /* Blue background */
        color: #fff;
    }

    .btn[type="reset"] {
        background-color: #dc3545;
        color: #fff;
    }

    #message {
        margin-bottom: 20px; /* Position message at the top */
        font-size: 16px;
        color: #333;
    }
</style>
</head>
<body>

<div class="popupupdate">
    <div id="message"></div> <!-- Move message to the top -->
    <div class="popupcontentupdate">
        <div class="popup_title">
            <h2>Inform Passenger</h2>
            <i class="fa-solid fa-close" id="closeupdate"></i>
        </div>
        <form id="updateform" class="login_form">
            <p>
                <select class="DeparturePlace" name="shiftupdate">
                    <option value="" name=""></option>
                    <option value="back" name="back">Back one day</option>
                    <option value="no" name="no">No Schedule</option>
                </select>
                <label style="font-size:20px;">Update option</label>
            </p>
            <p>
                <input type="datetime-local" class="month" name="departuredate" id="departur">
                <label for="departur">Date</label>
            </p>
            <p>
               <button type="submit" class="btn" name="update">Update</button>
               <button type="reset" class="btn">Clear</button>
            </p>
        </form>
    </div>
</div>

<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore.js"></script>
<script type="module">
  // Import the required Firebase modules
  import { initializeApp } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-app.js";
  import { getFirestore, collection, query, where, getDocs, updateDoc } from "https://www.gstatic.com/firebasejs/10.12.2/firebase-firestore.js";

  const firebaseConfig = {
      apiKey: "AIzaSyB5oz8imtcv828m-KAX-keSOA2MnMirQjQ",
      authDomain: "booktrainticket-11f56.firebaseapp.com",
      projectId: "booktrainticket-11f56",
      storageBucket: "booktrainticket-11f56.appspot.com",
      messagingSenderId: "1055917221881",
      appId: "1:1055917221881:web:88e868a8c48dfb551cff28",
      measurementId: "G-WHV3T8W1SH"
  };

  // Initialize Firebase
  const app = initializeApp(firebaseConfig);

  // Get a reference to the Firestore database
  const db = getFirestore(app);

  document.getElementById('updateform').addEventListener('submit', async (e) => {
      e.preventDefault(); // Prevent the default form submission

      const departureDate = document.getElementById('departur').value.split('T')[0]; // Get only the date part
      const shiftUpdateOption = document.querySelector('.DeparturePlace').value;

      if (!departureDate) {
          alert('Please select a date');
          return;
      }

      try {
          // Query the users collection to find documents with the same departureDate
          const q = query(collection(db, 'user'), where('Date', '==', departureDate));
          const querySnapshot = await getDocs(q);

          // Update the "Book Reference" and "Date" fields of the matching documents
          querySnapshot.forEach(async (doc) => {
              let newDate = new Date(departureDate);
              if (shiftUpdateOption === 'back') {
                  newDate.setDate(newDate.getDate() - 1); // Decrement by one day
              } else if (shiftUpdateOption === 'no') {
                  newDate.setDate(newDate.getDate() + 1); // Increment by one day
              }
              const nextDate = newDate.toISOString().split('T')[0];

              await updateDoc(doc.ref, {
                  "Book Reference": 'cancel',
                  "NewDate": nextDate
              });
          });

          console.log("Documents updated successfully");
          document.getElementById('message').textContent = 'Book Reference and Date updated successfully!';
      } catch (error) {
          console.error("Error updating document: ", error);
          document.getElementById('message').textContent = 'Error updating Book Reference and Date: ' + error.message;
      }
  });
</script>

</body>
</html>
