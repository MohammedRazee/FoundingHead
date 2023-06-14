// const quanClick = document.querySelectorAll(".quan");
// let x;

// quanClick.forEach ((button, index) => {
//     button.addEventListener("click", ()=> {
//         x = index;
//     })
// });

// sendIndex(x);

// function sendIndex(x) {
//     var xhr = new XMLHttpRequest();
//     var url = '../html/Cart.php';
//     var params = 'index=' + x;
  
//     xhr.open('POST', url, true);
//     xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
  
//     xhr.onreadystatechange = function() {
//       if (xhr.readyState == 4 && xhr.status == 200) {
//         console.log(xhr.responseText);
//       }
//     };
  
//     xhr.send(params);
//   }