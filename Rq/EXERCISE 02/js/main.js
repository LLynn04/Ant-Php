let result = document.getElementById("result");
let details = document.getElementById("detail");
let users = [
  {
    name: "Madden Medina",
    gender: "male",
    company: "BOINK",
    email: "maddenmedina@boink.com",
    phone: "+1 (808) 442-3969",
    address: "486 Jerome Avenue, Staples, American Samoa, 2014",
  },
  {
    name: "Graves Talley",
    gender: "male",
    company: "CEDWARD",
    email: "gravestalley@cedward.com",
    phone: "+1 (974) 449-3500",
    address: "807 Bristol Street, Bascom, Oklahoma, 4102",
  },
  {
    name: "Parks Greene",
    gender: "male",
    company: "ASSISTIA",
    email: "parksgreene@assistia.com",
    phone: "+1 (898) 550-2421",
    address: "392 Schenck Place, Taft, Virginia, 2053",
  },
  {
    name: "Georgina Bray",
    gender: "female",
    company: "GOKO",
    email: "georginabray@goko.com",
    phone: "+1 (870) 516-2040",
    address: "470 Taylor Street, Forbestown, District Of Columbia, 9290",
  },
  {
    name: "Hoover Lindsey",
    gender: "male",
    company: "WAZZU",
    email: "hooverlindsey@wazzu.com",
    phone: "+1 (942) 432-2941",
    address: "389 Herkimer Court, Beaulieu, Colorado, 2949",
  },
];

users.forEach((user, i) => {
  result.innerHTML += `<div class="card" onclick="clickshowDetails(${i})">${user.name}</div>`;
});

function clickshowDetails(index) {
  let user = users[index];
  details.innerHTML = `
   <h2>${user.name}</h2>
   <p><strong>Email:</strong> ${user.email}</p>
   <p><strong>Phone:</strong> ${user.phone}</p>
   <p><strong>Company:</strong> ${user.company}</p>
   <p><strong>Address:</strong> ${user.address}</p>
 `;
}
