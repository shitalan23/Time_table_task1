const addCardSection = document.getElementById("addCardSection");
const allCardsSection = document.getElementById("allCardsSection");

showAddCard();

/* Toggle submenu */
function toggleCards(e){
  e.preventDefault();
  const menu = document.getElementById("cardsMenu");
  const item = document.querySelector(".cards-item");

  if(menu.style.display === "block"){
    menu.style.display = "none";
    item.classList.remove("open");
  }else{
    menu.style.display = "block";
    item.classList.add("open");
  }
}

/* Views */
function showAddCard(){
  addCardSection.style.display = "block";
  allCardsSection.style.display = "none";
}

function showAllCards(){
  addCardSection.style.display = "none";
  allCardsSection.style.display = "block";
}

/* Image preview */
const imageInput = document.getElementById("imageInput");
const previewImg = document.getElementById("previewImg");

imageInput.addEventListener("change", function(){
  const file = this.files[0];
  if(file){
    const reader = new FileReader();
    reader.onload = () => {
      previewImg.src = reader.result;
      previewImg.style.display = "block";
    };
    reader.readAsDataURL(file);
  }
});
