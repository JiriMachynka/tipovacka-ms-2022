const groups = [
    "Skupina A",
    "Skupina B",
]

const teams = {
    "Skupina A": [
        "Kanada",
        "Německo",
        "Švýcarsko",
        "Slovensko",
        "Dánsko",
        "Kazachstán",
        "Francie",
        "Itálie"
    ],
    "Skupina B": [
        "Finsko",
        "USA",
        "Česko",
        "Švédsko",
        "Lotyšsko",
        "Norsko",
        "Velká británie",
        "Rakousko"
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

// selectionForTeams('winner')
// selectionForTeams('finalist')
// selectionForTeams('semifinalist1')
// selectionForTeams('semifinalist2')


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