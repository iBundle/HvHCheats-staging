

// --------- Add Functionality to the Sort Button in Picks Section

const sortBtn = document.querySelector("#picks-sort-btn");
const sortBy = [
  "date-up",
  "date-down",
  "name-up",
  "name-down",
  "price-up",
  "price-down",
  "likes-down",
];
let currentSortByIndex = 0;

sortBtn.addEventListener("click", () => {
  let btnIcon = "";
  let btnText = "";
  const container = document.querySelector("#picks-cards");
  container.innerHTML = "";

  currentSortByIndex =
    currentSortByIndex === sortBy.length - 1 ? 0 : currentSortByIndex + 1;

  switch (sortBy[currentSortByIndex]) {
    case "date-up":
      btnIcon = `<i class="fa-solid fa-arrow-down-wide-short"></i>`;
      btnText = "Date: Latest";
      itemsData
        .sort((pick1, pick2) => pick1.date_added - pick2.date_added)
        .forEach((pick, index) => {
          index < picksPerPage && generatePicksCard(pick);
        });
      break;

    case "date-down":
      btnIcon = `<i class="fa-solid fa-arrow-down-short-wide"></i>`;
      btnText = "Date: Oldest";
      itemsData
        .sort((pick1, pick2) => pick2.date_added - pick1.date_added)
        .forEach((pick, index) => {
          index < picksPerPage && generatePicksCard(pick);
        });
      break;

    case "name-up":
      btnIcon = `<i class="fa-solid fa-arrow-down-short-wide"></i>`;
      btnText = "Name: A-Z";
      itemsData
        .sort((pick1, pick2) => {
          if (pick1.title.toLowerCase() < pick2.title.toLowerCase()) {
            return -1;
          } else if (pick1.title.toLowerCase() > pick2.title.toLowerCase()) {
            return 1;
          } else {
            return 0;
          }
        })
        .forEach((pick, index) => {
          index < picksPerPage && generatePicksCard(pick);
        });
      break;

    case "name-down":
      btnIcon = `<i class="fa-solid fa-arrow-down-wide-short"></i>`;
      btnText = "Name: Z-A";
      itemsData
        .sort((pick1, pick2) => {
          if (pick1.title.toLowerCase() > pick2.title.toLowerCase()) {
            return -1;
          } else if (pick1.title.toLowerCase() < pick2.title.toLowerCase()) {
            return 1;
          } else {
            return 0;
          }
        })
        .forEach((pick, index) => {
          index < picksPerPage && generatePicksCard(pick);
        });
      break;

    case "price-up":
      btnIcon = `<i class="fa-solid fa-arrow-down-short-wide"></i>`;
      btnText = "Price: Low To High";
      itemsData
        .sort((pick1, pick2) => {
          if (pick1.current_bid < pick2.current_bid) {
            return -1;
          } else if (pick1.current_bid > pick2.current_bid) {
            return 1;
          } else {
            return 0;
          }
        })
        .forEach((pick, index) => {
          index < picksPerPage && generatePicksCard(pick);
        });
      break;

    case "price-down":
      btnIcon = `<i class="fa-solid fa-arrow-down-wide-short"></i>`;
      btnText = "Price: High to Low";
      itemsData
        .sort((pick1, pick2) => {
          if (pick1.current_bid > pick2.current_bid) {
            return -1;
          } else if (pick1.current_bid < pick2.current_bid) {
            return 1;
          } else {
            return 0;
          }
        })
        .forEach((pick, index) => {
          index < picksPerPage && generatePicksCard(pick);
        });
      break;

    case "likes-down":
      btnIcon = `<i class="fa-solid fa-arrow-down-wide-short"></i>`;
      btnText = "Most Popular";
      itemsData
        .sort((pick1, pick2) => {
          if (pick1.likes_count > pick2.likes_count) {
            return -1;
          } else if (pick1.likes_count < pick2.likes_count) {
            return 1;
          } else {
            return 0;
          }
        })
        .forEach((pick, index) => {
          index < picksPerPage && generatePicksCard(pick);
        });
      break;

    default:
      break;
  }

  sortBtn.innerHTML = `${btnIcon} Sort By: ${btnText}`;
});

// --------- Load More of "Today's Picks" Cards on Button Click

let picksPerPage = 8;

itemsData.forEach((pick, index) => {
  index < picksPerPage && generatePicksCard(pick);
});

const loadMoreBtn = document.querySelector("#picks-load");

loadMoreBtn.addEventListener("click", () => {
  const container = document.querySelector("#picks-cards");
  container.innerHTML = "";

  picksPerPage += 8;

  itemsData.forEach((pick, index) => {
    index < picksPerPage && generatePicksCard(pick);
  });
});

// --------- Change Filter Button Styles on Click in Picks Section

const filterBtns = [...document.querySelectorAll(".picks__filter-btn")];

filterBtns.forEach((btn) =>
  btn.addEventListener("click", () => {
    btn.classList.toggle("picks__filter-btn--active");
  })
);
