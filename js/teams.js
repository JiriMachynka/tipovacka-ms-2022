const groups = [
    "Skupina A",
    "Skupina B",
    "Skupina C",
]

const teams = {
    "Skupina A": [
        "Liberec",
        "Třinec",
        "Kometa Brno",
        "Olomouc",
    ],
    "Skupina B": [
        "Plzeň",
        "Litvínov",
        "Mladá Boleslav",
        "Karlovy Vary",
    ],
    "Skupina C": [
        "Pardubice",
        "Vítkovice",
        "Sparta Praha",
        "Mountfield HK"
    ]
}

const group_select = document.getElementById("group")
const home_select = document.getElementById("home")
const away_select = document.getElementById("away")

// Načítání názvů skupin
groups.forEach((group) => {
    const option_node = document.createElement("option")
    option_node.innerText = group
    option_node.value = group
    group_select.appendChild(option_node)
})

const changeHomeTeam = (group) => {
    // Vymazání obsahu pro options u domácích týmů
    home_select.innerHTML = ""
    for (const [group_, teams_] of Object.entries(teams)) {
        // Pokud se skupina rovná té kterou jsme si zvolili
        if (group == group_) {
            teams_.forEach((team) => {
                // Vytváření options u domácích týmů s názvy a hodnotami týmů ze skupiny X
                const option_node = document.createElement("option")
                option_node.innerText = team
                option_node.value = team
                home_select.appendChild(option_node)
            })
        }
    }
}

const changeAwayTeam = (group, team_) => {
    // Vymazání obsahu pro options u domácích týmů
    away_select.innerHTML = ""
    for (const [group_, teams_] of Object.entries(teams)) {
        // Pokud se skupina rovná té kterou jsme si zvolili
        if (group == group_) {
            teams_.forEach((team) => {
                if (team_ != team) {
                    // Vytváření options u domácích týmů s názvy a hodnotami týmů ze skupiny X
                    const option_node = document.createElement("option")
                    option_node.innerText = team
                    option_node.value = team
                    away_select.appendChild(option_node)
                }
            })
        }
    }
}

// Na začátku
// Zjištění hodnoty z výběru skupin
const group = group_select.value
changeHomeTeam(group)
// Zjištění hodnoty z výběru domácích týmů
const homeTeam = home_select.value
changeAwayTeam(group, homeTeam)

// Při změně skupiny
const selectedGroup = () => {
    const group = group_select.value
    changeHomeTeam(group)
    const homeTeam = home_select.value
    changeAwayTeam(group, homeTeam)
}

// Při změně týmu domácích
const selectedHomeTeam = () => {
    const group = group_select.value
    const homeTeam = home_select.value
    changeAwayTeam(group, homeTeam)
}

// FINAL MATCH SCORE - SECTION
const select_team = () => {
    for (const [group, teams_] in Object.entries(teams)) {
        teams_.forEach((team) => {
            console.log(team)
        })
        // console.log(`${group}: ${team}`)
    }
}
select_team()