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