const groups = [
    "Skupina A",
    "Skupina B",
    "Skupina C",
    "Skupina D",
    "Skupina E",
    "Skupina F",
    "Skupina G",
    "Skupina H",
]

const teams = {
    "Skupina A": [
        "Katar",
        "Ekvádor",
        "Senegal",
        "Nizozemsko",
    ],
    "Skupina B": [
        "Anglie",
        "Írán",
        "USA",
        "Wales"
    ],
    "Skupina C": [
        "Argentina",
        "Saudská Arábie",
        "USA",
        "Wales"
    ],
    "Skupina D": [
        "Francie",
        "Austrálie",
        "Dánsko",
        "Tunisko"
    ],
    "Skupina E": [
        "Španělsko",
        "Kostarika",
        "Německo",
        "Japonsko"
    ],
    "Skupina F": [
        "Belgie",
        "Kanada",
        "Maroko",
        "Chorvatsko"
    ],
    "Skupina G": [
        "Brazílie",
        "Srbsko",
        "Švýcarsko",
        "Kamerun"
    ],
    "Skupina H": [
        "Portugalsko",
        "Ghana",
        "Uruguay",
        "Jižní Korea"
    ],
}

const selectionForTeams = (id) => {
    const element = document.getElementById(id)
    if (element != null) {
        for (const [group_, teams_] of Object.entries(teams)) {
            const optgroup = document.createElement("optgroup")
            optgroup.label = group_
            element.appendChild(optgroup)
            teams_.forEach((t) => {
                const option = document.createElement("option")
                option.innerText = t
                option.value = t
                optgroup.appendChild(option)
            })
        }
    }
}

const chooseTeam = (select, team) => {
    const element = document.getElementById(select)
    if (element != null) {
        for (const [group_, teams_] of Object.entries(teams)) {
            const optgroup = document.createElement("optgroup")
            optgroup.label = group_
            element.appendChild(optgroup)
            teams_.forEach((t) => {
                const option = document.createElement("option")
                option.innerText = t
                option.value = t
                if (team == t) option.selected = true
                optgroup.appendChild(option)
            })
        }
    }
}