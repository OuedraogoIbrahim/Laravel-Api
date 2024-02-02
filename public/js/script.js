async function myData() {
    const DATA = await fetch('https://apiv2.allsportsapi.com/football?met=Fixtures&APIkey=  06a6241166f18306f75439b45ccd0f0cbfe1c3e8f5f3ebd4e7425f52ea970ce7 &from=10-01-2024&to=10-01-2024&leagueId=302');
    console.log(DATA);
}

myData();