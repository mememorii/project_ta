  document.addEventListener("DOMContentLoaded", function() {
      // Get form 
      var form = document.getElementById("myForm");
      // Get hidden input
      var ratingValueInput = document.getElementById("ratingValue");
      // Get modal
      var popup = document.getElementById("ratingPopup");
      // get close
      var closeSpan = document.getElementsByClassName("close")[0];
      // get semua rat input
      var ratingInputs = document.querySelectorAll(".rating-input");
      // cek apa udah milih
      var ratingSelected = false;
      // ketika submit cegah dan display modal 
      form.onsubmit = function(event) {
          if (!ratingSelected) {
              event.preventDefault(); // cegah submit
              popup.style.display = "flex"; 
          }
      }

      // ketika user menekan x = close
      closeSpan.onclick = function() {
          popup.style.display = "none";
      }

      //ketika user menekan diluar modal maka close
      window.onclick = function(event) {
          if (event.target == popup) {
              popup.style.display = "none";
          }
      }

      // ketika user menekan rating maka updaate input hidden lalu submit
      ratingInputs.forEach(function(input) {
          input.addEventListener('change', function() {
              ratingSelected = true;
              ratingValueInput.value = this.value; // update input hidden ke pilihan
              popup.style.display = "none";
              form.submit(); 
          });
      });
  });


    const stars = document.querySelectorAll('.star-rating input');
    stars.forEach(star => {
        star.addEventListener('change', () => {
            document.querySelectorAll('.star-rating label').forEach(label => {
                label.style.color = '#ddd'; // reset color
            });
            for (let i = star.value; i >= 1; i--) {
                document.querySelector(`label[for="rating-${i}"]`).style.color = 'gold';
            }
        });
    });

document.addEventListener("DOMContentLoaded", function() {
    // Example value, replace with your logic to fetch or determine the value
    let value = 3; // Example value, replace with your logic

    // Loop through each radio button and select based on the value
    for (let i = 1; i <= 5; i++) {
        document.getElementById("radio" + i).checked = (i <= value);
    }
});
