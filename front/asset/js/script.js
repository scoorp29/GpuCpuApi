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

// warning : handle no first item
function generateTable (table, dataList) {
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

function fillCpu () {
    let cpuTable = document.getElementById('cpu-table')
    // this code was without ajax request
    let cpuList = getCpuList()
    generateTable(cpuTable, cpuList)

    // $.ajax({
    //     url: 'https://api-cpu-gpu.itcommunity.fr/api/cpu',
    //     method: 'GET',
    //     dataType: 'json'
    // }).done(response => {
    //     let cpuList = JSON.stringify(response)
    //     console.log('done')
    //     console.log(cpuList)
    //     generateTable(cpuTable, cpuList)
    // })
}

function fillGpu () {
    let gpuTable = document.getElementById('gpu-table')
    let gpuList = getGpuList()
    generateTable(gpuTable, gpuList)
}

function onLoad () {
    fillCpu()
    fillGpu()
    
    let selectorList = ['#cpu-table', '#gpu-table']
    selectorList.map(selector => {
        let $element = $(selector)
        $element.tablesorter()
    })
}

document.addEventListener('DOMContentLoaded', onLoad)