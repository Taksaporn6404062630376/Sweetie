async function getDataFromAPI() {
  let response = await fetch(
    "https://data.go.th/dataset/24c949fc-a032-480e-a7ce-7f88ac41f00e/resource/913fd3cc-e839-4c00-a5d6-07e6c073752c/download/department_store.json"
  );
  let rawData = await response.text();
  let objectData = JSON.parse(rawData);
  let result = document.getElementById("footer-result");
  // console.log("n")
  let table = document.createElement('table');
  for (let i = 34; i < 37; i++) {
      let row = document.createElement('tr');

      let nameCell = document.createElement('td');
      nameCell.textContent = 'สาขา: '+objectData.features[i].properties.name;
      row.appendChild(nameCell);

      let addressCell = document.createElement('td');
      addressCell.textContent = 'ที่ตั้ง: '+objectData.features[i].properties.address;
      row.appendChild(addressCell);

      let telCell = document.createElement('td');
      telCell.textContent = 'เบอร์โทรศัพท์: '+objectData.features[i].properties.tel;
      row.appendChild(telCell);

      let timeCell = document.createElement('td');
      timeCell.textContent = objectData.features[i].properties.time;
      row.appendChild(timeCell);

      table.appendChild(row);
  }

  result.appendChild(table);
}

getDataFromAPI();
