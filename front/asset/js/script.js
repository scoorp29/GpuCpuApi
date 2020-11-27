// sticky navbar
let navbar = document.getElementById('navbar')

function onScroll () {
    if (window.pageYOffset > navbar.offsetTop)
    {
        navbar.classList.add('sticky')
    } else {
        navbar.classList.remove('sticky')
    }
}
document.addEventListener('scroll', onScroll)

// fake data

function addIndex (tab) {
    return tab.map((value, index) => {
        value["id"] = index
        return value
    })
}

function generateSameValueList (value, size) {
    return Array.apply(null, Array(size)).map(_ => Object.assign({}, value))
}

function generateList  (value) {
    let list = generateSameValueList(value, 20)
    list = addIndex(list)
    return list
}

function getCpuList () {
    const item = {
        "company": "AMD",
        "product_name": "Athlon 220GE",
        "code_name": "Zen",
        "core": "2 / 4",
        "clock": "3.4 GHz",
        "socket": "Socket AM4",
        "process": "14 nm",
        "l3_cache": "4MB",
        "tdp": "35 W",
        "released": "Dec 21st, 2018",
    }
    return generateList(item)
}

function getGpuList () {
    const item = {
        "company": "AMD",
        "product_name": "Radeon RX 550X",
        "gpu_chip": "Lexa",
        "release_date": "Dec 16th, 2018",
        "bus": "PCIe 3.0 x8",
        "memory": "4 GB, GDDR5, 128 bit",
        "gpu_lock": "1100 MHz",
        "memory_lock": "1500 MHz",
        "shaders": "512 / 32 / 16",
    }
    return generateList(item)
}

function getCpuCountList () {
    const item = [
        {
          "company": "AMD",
          "count": "134"
        },
        {
          "company": "Intel",
          "count": "171"
        }
      ]
    return item
}

function getGpuCountList () {
    const item = [
        {
          "company": "AMD",
          "count": "131"
        },
        {
          "company": "Intel",
          "count": "31"
        },
        {
          "company": "NVIDIA",
          "count": "139"
        }
    ]
    return item
}



function wrapContent (element, tagName) {
    let wrapper = document.createElement(tagName)
    wrapper.classList.add('wrapper')
    wrapper.innerText = element.innerText
    element.innerText = ''
    element.appendChild(wrapper)
    return element
}

function generateHeader (values, forbiddenColumns) {
    let row = document.createElement('tr')
    row.classList.add('row')
    
    let cellList = document.createDocumentFragment()
    
    for (const value of values) {
        if (forbiddenColumns.includes(value)) {
            continue
        }
        let cell = document.createElement('th')
        cell.innerText = value
        cell.classList.add('cell')
        cellList.appendChild(cell)
    }
    row.appendChild(cellList)
    return row
}

/**
 * warning : XSS at innerText ?
 **/
function generateRow(data, forbiddenColumns) {
    let row = document.createElement('tr')
    row.classList.add('row')
    row.setAttribute('data-id', data.id)

    let cellList = document.createDocumentFragment()

    for (const [columnName, value] of Object.entries(data)) {
        if (forbiddenColumns.includes(columnName)) {
            continue
        }
        let cell = document.createElement('td')
        cell.innerText = value
        cell.classList.add('cell')
        cellList.appendChild(cell)
        cell.setAttribute('data-label', columnName)
    }
    row.appendChild(cellList)
    return row
}

function removeChilds (element) {
    while (element.firstChild) {
        element.removeChild(element.lastChild);
    }
}

// warning : handle no first item
function generateTable (table, dataList) {
    if (!dataList) {
        return
    }
    removeChilds(table)
    table.classList.add('table')
    forbiddenColumns = ['id']

    // header part
    let tableHeader = document.createElement('thead')
    tableHeader.classList.add('table-header')

    let headerList = Object.keys(dataList[0])
    let tableHeaderRow = generateHeader(headerList, forbiddenColumns)
    tableHeader.appendChild(tableHeaderRow)


    // content part
    let tableContent = document.createElement('tbody')
    tableContent.classList.add('table-content')

    let tableContentRowList = document.createDocumentFragment()
    
    for (const data of dataList) {
        let row = generateRow(data, forbiddenColumns)
        tableContentRowList.appendChild(row)
    }
    tableContent.appendChild(tableContentRowList)

    table.appendChild(tableHeader)
    table.appendChild(tableContent)
}

function init () {
    $.ajaxSetup({
        // crossDomain: true,
        // crossOrigin: true,
        // url: 'https://api-cpu-gpu.itcommunity.fr/api/',
        // global: false,
        // contentType: 'application/json; charset=utf-8'
        contentType: 'application/json; charset=utf-8',
        dataType: 'json',
    })
}

function fillCpu () {
    let cpuTable = document.getElementById('cpu-table')
    let cpuList
    $.ajax({
        url: 'https://api-cpu-gpu.itcommunity.fr/api/cpu',
        type: 'GET',
        method: 'GET',
    }).done(response => {
        cpuList = response
    }).fail( _ => {
        console.warn('AJAX error /api/cpu')
        cpuList = getCpuList()
    }).always(_=> {
        generateTable(cpuTable, cpuList)
        $('#cpu-table').tablesorter()
    })
}

function fillGpu () {
    let gpuTable = document.getElementById('gpu-table')
    let gpuList
    $.ajax({
        url: 'https://api-cpu-gpu.itcommunity.fr/api/gpu',
        type: 'GET',
        method: 'GET',
    }).done(response => {
        gpuList = response
    }).fail( _ => {
        console.warn('AJAX error /api/gpu')
        gpuList = getGpuList()
    }).always(_=> {
        generateTable(gpuTable, gpuList)
        $('#gpu-table').tablesorter()
    })
}

function fillCpuCount () {
    let cpuCountList
    $.ajax({
        url: 'https://api-cpu-gpu.itcommunity.fr/api/cpu/count',
        type: 'GET',
        method: 'GET',
    }).done(cpuCountList => {
        buildCpuCountGraph(cpuCountList)
    }).fail( _ => {
        console.warn('AJAX error /api/cpu-count')
        cpuCountList = getCpuCountList()
        buildCpuCountGraph(cpuCountList)
    })
}

function fillGpuCount () {
    let gpuCountList
    $.ajax({
        url: 'https://api-cpu-gpu.itcommunity.fr/api/gpu/count',
        type: 'GET',
        method: 'GET',
    }).done(gpuCountList => {
        buildGpuCountGraph(gpuCountList)
    }).fail( _ => {
        console.warn('AJAX error /api/gpu-count')
        gpuCountList = getGpuCountList()
        buildGpuCountGraph(gpuCountList)
    })
}

function buildCpuCountGraph (gpuCountList) {
    let element = document.getElementById('cpu-count')
    let context = element.getContext('2d')
    let chart = new Chart(context, {
        type: 'bar',
        data: {
            labels: gpuCountList.map(element => element.company),
            datasets: [
                {
                    label: '# of CPU.',
                    data: gpuCountList.map(element => element.count),
                    backgroundColor: [
                        'rgba(253, 0, 2, 0.2)',
                        'rgba(0, 113, 197, 0.2)',
                    ],
                    borderColor: [
                        'rgba(253, 0, 2, 1)',
                        'rgba(0, 113, 197, 1)',
                    ],
                    borderWidth: 1
                },
            ],
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
            legend: {
                display: false
            },
            tooltips: {
                callbacks: {
                   label: function(tooltipItem) {
                          return tooltipItem.yLabel;
                   }
                }
            }
        }
    })
}

function buildGpuCountGraph (gpuCountList) {
    let element = document.getElementById('gpu-count')
    let context = element.getContext('2d')

    let chart = new Chart(context, {
        type: 'doughnut',
        data: {
            labels: gpuCountList.map(element => element.company),
            datasets: [{
                label: '# of GPU.',
                data: gpuCountList.map(element => element.count),
                backgroundColor: [
                    'rgba(253, 0, 2, 0.2)',
                    'rgba(0, 113, 197, 0.2)',
                    'rgba(116, 183, 27, 0.2)',
                ],
                borderColor: [
                    'rgba(253, 0, 2, 1)',
                    'rgba(0, 113, 197, 1)',
                    'rgba(116, 183, 27, 1)'
                ],
                borderWidth: 1,
            }],
            
        },
        options: {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            },
        }
    })
}

function onLoad () {
    init()

    fillCpu()
    fillGpu()
    fillCpuCount()
    fillGpuCount()
}

document.addEventListener('DOMContentLoaded', onLoad)