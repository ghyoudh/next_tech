const menu = document.querySelector("#mobile-menu");
const menuLinks = document.querySelector(".navbar__menu");

menu.addEventListener("click", function () {
  menu.classList.toggle("is-active");
  menuLinks.classList.toggle("active");
});

const apiKey = "14419e5a4568e9cf9d3b84af7055bcca"; // ←  مفتاح API هنا
const url = `https://gnews.io/api/v4/top-headlines?topic=technology&lang=en&token=${apiKey}`;

fetch(url)
  .then((response) => response.json())
  .then((data) => {
    const container = document.getElementById("news__container");
    container.innerHTML = ""; // Clear the loading message
    data.articles.forEach((article) => {
      const newsItem = document.createElement("div");
      newsItem.className = "news__card";
    
      newsItem.innerHTML = `
        <div>
          <img src="${article.image || "https://via.placeholder.com/150"}" 
               alt="News Image" 
               style="width: 25%; height: 100%; border-radius: 5px;">
        </div>
        
          <h2><a href="${article.url}" target="_blank">${article.title}</a></h2>
          <p>${article.description || "No description available."}</p>
        <button class="news__btn" onclick="window.open('${article.url}', '_blank')">Read More</button>
      `;
    
      container.appendChild(newsItem);
    });
  })
  .catch((error) => {
    console.error("Error fetching news:", error);
    const container = document.getElementById("news__container");
    container.innerHTML = `<p style="color: red;">Failed to load news. Please try again later.</p>`;
  });

function getNews(keyword) {
  const catUrl = `https://gnews.io/api/v4/search?q=${encodeURIComponent(
    keyword
  )}&topic=technology&lang=en&token=${apiKey}`;

  fetch(catUrl)
    .then((res) => res.json())
    .then((data) => {
      const container = document.getElementById("news__container");
      container.innerHTML = "";
      data.articles.forEach((article) => {
        container.innerHTML += `
            <div class="news">
                <div class="news__img">
                  <img src="${
                    article.image || "https://via.placeholder.com/150"
                  }" alt="News Image">
                </div>
                <div class="news__content"> 
                  <h2><a href="${article.url}" target="_blank">${
          article.title
        }</a></h2>
                  <p>${article.description || "No description available."}</p>
                </div>
              
            </div>
          `;
      });
    })
    .catch((err) => {
      const container = document.getElementById("news__container");
      container.innerHTML =
        '<p style="color: red;">Error loading news. Please try again later.</p>';
      console.error(err);
    });
}

function updateCategoryTitle(category) {
  document.getElementById('category-title').textContent = category;
}