var debit = 0
var credit = 0
var price = 0
var pastQuantity = 0


// Functions
function joborderButton(){
    document.getElementById('panel-joborder').style.display = "block";
    document.getElementById('panel-inventory').style.display = "none";
    document.getElementById('panel-employee').style.display = "none";
    document.getElementById('panel-schedules').style.display = "none";
    document.getElementById('panel-installation').style.display = "none";
    
    document.getElementById('nb1').style.backgroundColor = "#1abc9c";
    document.getElementById('nb2').style.backgroundColor = "#ECF0F1";
    document.getElementById('nb3').style.backgroundColor = "#ECF0F1";
    document.getElementById('nb4').style.backgroundColor = "#ECF0F1";
    document.getElementById('nb5').style.backgroundColor = "#ECF0F1";
}
function inventoryButton(){
    document.getElementById('panel-joborder').style.display = "none";
    document.getElementById('panel-inventory').style.display = "block";
    document.getElementById('panel-employee').style.display = "none";
    document.getElementById('panel-schedules').style.display = "none";
    document.getElementById('panel-installation').style.display = "none";

    document.getElementById('nb1').style.backgroundColor = "#ECF0F1";
    document.getElementById('nb2').style.backgroundColor = "#1abc9c";
    document.getElementById('nb3').style.backgroundColor = "#ECF0F1";
    document.getElementById('nb4').style.backgroundColor = "#ECF0F1";document.getElementById('nb5').style.backgroundColor = "#ECF0F1";
}
function employeeButton(){
    document.getElementById('panel-joborder').style.display = "none";
    document.getElementById('panel-inventory').style.display = "none";
    document.getElementById('panel-employee').style.display = "block";
    document.getElementById('panel-schedules').style.display = "none";
    document.getElementById('panel-installation').style.display = "none";

    document.getElementById('nb1').style.backgroundColor = "#ECF0F1";
    document.getElementById('nb2').style.backgroundColor = "#ECF0F1";
    document.getElementById('nb3').style.backgroundColor = "#1abc9c";
    document.getElementById('nb4').style.backgroundColor = "#ECF0F1";document.getElementById('nb5').style.backgroundColor = "#ECF0F1";
}

function schedulesButton(){
    document.getElementById('panel-joborder').style.display = "none";
    document.getElementById('panel-inventory').style.display = "none";
    document.getElementById('panel-employee').style.display = "none";
    document.getElementById('panel-schedules').style.display = "block";
    document.getElementById('panel-installation').style.display = "none";

    document.getElementById('nb1').style.backgroundColor = "#ECF0F1";
    document.getElementById('nb2').style.backgroundColor = "#ECF0F1";
    document.getElementById('nb3').style.backgroundColor = "#ECF0F1";
    document.getElementById('nb4').style.backgroundColor = "#1abc9c";document.getElementById('nb5').style.backgroundColor = "#ECF0F1";
}
function installationButton(){
    document.getElementById('panel-joborder').style.display = "none";
    document.getElementById('panel-inventory').style.display = "none";
    document.getElementById('panel-employee').style.display = "none";
    document.getElementById('panel-schedules').style.display = "none";
    document.getElementById('panel-installation').style.display = "block";

    document.getElementById('nb1').style.backgroundColor = "#ECF0F1";
    document.getElementById('nb2').style.backgroundColor = "#ECF0F1";
    document.getElementById('nb3').style.backgroundColor = "#ECF0F1";
    document.getElementById('nb4').style.backgroundColor = "#ECF0F1";document.getElementById('nb5').style.backgroundColor = "#1abc9c";
}

function closer(id1, id2){
    document.getElementById(id1).style.display = 'none';
    document.getElementById(id2).style.display = 'none';
}
function closer2(id1, id2){
    document.getElementById(id1).style.display = 'none';
    document.getElementById(id2).style.display = 'none';
    document.getElementById('material-table').innerHTML = ''
}
function popout(id1, id2){
    document.getElementById(id1).style.display = "grid";
    document.getElementById(id2).style.display = "block";
}

function otherDevice(that){
    if(that.value == "others"){
        document.getElementById('other-div').style.display = "inline"
        document.getElementById('other-div').classList.add('inputfield')
        document.getElementById('input5').style.width = "10%"
        document.getElementById('input5').classList.remove('inputfield')

    }else{
        document.getElementById('other-div').style.display = "none";
        document.getElementById('other-div').classList.remove('inputfield')
        document.getElementById('input5').style.width = "30%";
        document.getElementById('input5').classList.add('inputfield')
    }
}

function popup(error){
    document.getElementById(error).style.visibility = "visible"
    document.getElementById(error).style.opacity = 1;
}
function popoff(that){
    that.style.visibility = "hidden"
    var str = document.getElementsByClassName('error')
    for (var i = 0; i<str.length; i++)
        str[i].style.visibility = "hidden"
}

function submitToForm(input,str2){
    console.log('Inputs ', input)
    switch(input){
        
        case 'final-inputs':
            var str = 'add-joborder'
            var inputs = document.getElementsByClassName(input)
            console.log(`Inputs Length = ${inputs.length}`);
            for(var i = 0; i < inputs.length; i++){
                var temp = `${str}${i+13}`
                if(i == 1){
                    document.getElementById(temp).value = appendMaterials()
                    console.log(document.getElementById(temp).value);
                    continue
                }
                document.getElementById(temp).value = inputs[i].value
                console.log(document.getElementById(temp).value);
            }
            document.getElementById('add-joborder20').value = 'Finished'
            console.log(document.getElementById('add-joborder20').value)
        break

        case 'update-inventory-input':
            // for updates
            var inputs = document.getElementsByClassName(input)
            var diff;
            var quantity = 0;
            for(var i = 0; i<inputs.length; i++){
                var temp = `${str2}${i+1}`
                document.getElementById(temp).value = inputs[i].value
                if(i == 2)
                    price = parseInt(document.getElementById(temp).value)
                if(i == 3)
                    quantity = parseInt(document.getElementById(temp).value)
            }
            // For logs
            diff = pastQuantity - quantity
            if(diff >= 0){
                credit = diff
                price *= diff
            }else{
                debit = diff * -1;
                price *= diff * -1;
            }

            var log = document.getElementsByClassName('log')
            console.log(`log length = ${log.length}`);
            log[0].value = parseInt(inputs[0].value)
            log[1].value = inputs[1].value
            log[2].value = debit
            log[3].value = credit
            log[4].value = price
            log[5].value = quantity
        break

        case 'update-installation-input':
          var inputs = document.getElementsByClassName('update-installation-input')
          // console.log('Update installation: ', inputs.length)
          var inputs = document.getElementsByClassName(input)
          for(var i = 0; i<inputs.length; i++){
            console.log(inputs[i].value)
            var temp = `update-installation${i+1}`
            // console.log(temp)
            // console.log(document.getElementById(temp))
            document.getElementById(temp).value = inputs[i].value
            console.log(`${temp} = ${document.getElementById(temp).value}`);

          }
        break;
        
        default:
            var inputs = document.getElementsByClassName(input)
            for(var i = 0; i<inputs.length; i++){
            console.log(inputs[i].value)
                var temp = `${str2}${i+1}`
                console.log(temp)
                console.log(document.getElementById(temp))
                document.getElementById(temp).value = inputs[i].value
                console.log(`${temp} = ${document.getElementById(temp).value}`);

            }
            document.getElementById('add-joborder20').value = 'Pending'
            console.log(document.getElementById('add-joborder20').value);
        break
    }
}

function checker(str1, str2, input, error){
    var submit = `${str2}-submit`
    console.log(submit);
    var count = 0
    var inputs = document.getElementsByClassName(input)
    console.log(inputs.length);
    
    for (var i = 0; i< inputs.length; i++){
        if(inputs[i].value == ""){
            console.log(inputs[i].value);
            var str = error+(i+1)
            popup(str);
            count++
        }
    }
    if (count == 0){
        submitToForm(input, str2)
        console.log('Near to pass');
        document.getElementById(submit).click()
        closer(str1,str2)
    }
        
}
function finalChecker(str1, str2, input, error){
    var submit = `${str2}-submit`

        submitToForm(input, str2)
        console.log('Near to pass');
        document.getElementById(submit).click()
        // closer(str1,str2)

        
}

function appendMaterials(){
    var str = ''
    var str2 = ''
    var str3 = ''
    var str4 = ''
    var str5 = ''

    var inputs = document.getElementsByClassName('materials_select')
    var materials = document.getElementsByClassName('final-select')
    var quantities = document.getElementsByClassName('quantity_data')
    var credits = document.getElementsByClassName('credit_data')
    var number = document.getElementsByClassName('number_data')

    for(var i = 0; i<inputs.length; i++)
        str += `${inputs[i].value}---`

    for(var i = 0; i<materials.length; i++)
        str2 += `${materials[i].value}---`
    
    for(var i = 0; i<quantities.length; i++)
        str3 += `${quantities[i].value}---`

    for(var i = 0; i<credits.length; i++)
        str4 += `${credits[i].value}---`

    for(var i = 0; i<number.length; i++)
        str5 += `${number[i].value}---`

    document.getElementById('material_data').value = str2
    document.getElementById('quantity_data').value = str3
    document.getElementById('credit_data').value = str4
    document.getElementById('number_data').value = str5

    console.log(`material data = ${document.getElementById('material_data').value}`);
    console.log(`quantity data = ${document.getElementById('quantity_data').value}`);
    console.log(`credit data = ${document.getElementById('credit_data').value}`);
    console.log(`number data = ${document.getElementById('number_data').value}`);


    return str
}

function search(){
    var input, filter, table, tr, td, i, txtvalue;
    input = document.getElementById('joborder-search')
    filter = input.value.toUpperCase()
    table = document.getElementById('joborder-table')
    tr = table.getElementsByTagName('tr')

    for(i = 0; i<tr.length; i++){
        td = tr[i].getElementsByTagName('td')[1]
        if(td){
            txtvalue = td.textContent || td.innerText
            if(txtvalue.toUpperCase().indexOf(filter) > -1)
                tr[i].style.display = ""
            else
                tr[i].style.display = "none"
        }
    }
}

function filter(that,str){
    // console.log('Filter Pending');
    var filter, table, tr, td, txtvalue, buttons; 
    filter = str
    table = document.getElementById('joborder-table')
    tr = table.getElementsByTagName('tr')

    if(str == ''){
        for(var i=1; i<tr.length; i++)
            tr[i].style.display = ''
    }else{
        for(var i=1; i<tr.length; i++){
            td = tr[i].getElementsByTagName('td')
            txtvalue = td[19].innerText
            // console.log(`length = ${td.length}`);
            // console.log(`status = ${txtvalue}`);
            if(txtvalue == filter)
                tr[i].style.display = ''
            else
                tr[i].style.display = 'none'
        }
    }

    
    buttons = document.getElementsByClassName('fbtns')
    for(var i = 0; i<buttons.length; i++)
        buttons[i].style.backgroundColor = '#34495E'
    that.style.backgroundColor = '#3498DB'
}

function showLogs(that,id){
    switch(id){
        case 'inventory-table':
            document.getElementById(id).style.display = ''
            document.getElementsByClassName(that.classList[0])[0].style.backgroundColor = '#3498DB'
            document.getElementById('inventory-logs').style.display = 'none'
            document.getElementsByClassName(that.classList[0])[1].style.backgroundColor = '#34495E'

        break

        case 'inventory-logs':
            document.getElementById(id).style.display = ''
            document.getElementsByClassName(that.classList[0])[1].style.backgroundColor = '#3498DB'
            document.getElementById('inventory-table').style.display = 'none'
            document.getElementsByClassName(that.classList[0])[0].style.backgroundColor = '#34495E'

        break
    }
}

function editJobOrder(that){
    var td = that.getElementsByTagName('td')

    if(td.length > 4 && td[20].innerText == 'Pending'){
        console.log('pending');
        fillInputFields('final-inputfield',td)
        popout('forms','add-joborder-final')
    }else if(td.length > 4 && td[20].innerText == 'Finished'){
        console.log('Finished');
        fillReciept('reciept-input',td)
        popout('forms','official-reciept-div')
    }
}

function editInstallation(that){
  var td = that.getElementsByTagName('td')
  console.log(td[0].innerText)
  let inputFields = document.getElementsByClassName('update-installation-input')
  console.log(inputFields[0])
  for(let i=1; i<=inputFields.length; i++){
    inputFields[i-1].value = td[i].innerText 
    console.log(td[i].innerText)
  }
  inputFields[inputFields.length-1].value = parseInt(td[0].innerText)
  popout('forms', 'update-installation')
}

function editInputs(that, str){
    var td = that.getElementsByTagName('td')
    switch(str){
        case 'inventory':
            fillInputFields('update-inventory-input',td)
            pastQuantity = parseInt(td[3].innerText)
            console.log(`past quantity = ${pastQuantity}`)
            popout('forms','update-inventory')
        break

        case 'employee':
            fillInputFields('upemployee-input',td)
            document.getElementById('add-employee1').value = td[0].innerText
            popout('forms','update-employee')
        break

        case 'schedules':
            fillInputFields('update-inventory-input',td)
            pastQuantity = parseInt(td[3].innerText)
            console.log(`past quantity = ${pastQuantity}`)
            popout('forms','update-inventory')
        break
    }
}
var jon;
var sched_name;
var nameInput;

function fillInputFields(inputfield, td){
    var inpufields = document.getElementsByClassName(inputfield)
    // for inventory and employee
    if(td.length == 4 || td.length == 5){
        for(var i = 0; i<inpufields.length; i++)
            inpufields[i].value = td[i].innerText
        
    }else{
        // for job-order
        for(var i = 0; i<inpufields.length; i++){
            if(td[i].innerText != ""){
                if(i == 0)
                    jon = td[i].innerText
                if(i == 1)
                    sched_name = td[i].innerText
                inpufields[i].value = td[i+1].innerText
            }
        }
        document.getElementById('jon').value = jon
        document.getElementById('add-joborder1').value = sched_name
    }
}

function fillReciept(inputfield, td){
    var inpufields = document.getElementsByClassName(inputfield)
    
    for(var i = 0; i<inpufields.length; i++){
            if(i == 14){
                var temp = td[i].innerText
                var arr = temp.split('---')
                createRows(arr)
                continue
            }
            inpufields[i].innerText = td[i].innerText
    }
}

function createRows(array){
    var table = document.getElementById('material-table')
    table.innerHTML = '<tr><th>Quantity</th><th>Materials</th><th>Price</th></tr>'
    var count = 0;
    for(var i = 0; i < array.length; i++){
        if(i == 0 || i % 3 == 0){
            count++
            var tr = document.createElement('TR')
            tr.setAttribute('id',`mytr${count}`)
            table.appendChild(tr)
        }
        var td = document.createElement('TD')
        var cell = array[i]
        td.innerText = cell
        document.getElementById(`mytr${count}`).appendChild(td)
    }
}

var i = 0;

function duplicate(){
    var original = document.getElementById('materials' + i);
    var clone = original.cloneNode(true); // "deep" clone
    clone.id = "materials" + ++i; // there can only be one element with an ID
    original.parentNode.appendChild(clone)

    if(i > 0)
        document.getElementById('fa-minus').style.display = 'inline'
    else   
        document.getElementById('fa-minus').style.display = 'none'
}

function removeDuplicate(){
    document.getElementById('materials'+i).remove()
    i--
    if(i > 0)
        document.getElementById('fa-minus').style.display = 'inline'
    else   
        document.getElementById('fa-minus').style.display = 'none'
}

// function getPrice(){
//     var idName = document.getElementById('materials' + i)
//     var prices = idName.getElementsByClassName("price-list")[0]
//     var selected = prices.selectedIndex
//     idName.getElementsByClassName("final-select")[2].value = (prices.options[selected].value) * idName.getElementsByClassName("final-select")[0].value
// }

function getPrice(that){
    var parent = document.getElementById(that.parentNode.id)
    var names = parent.getElementsByClassName('final-select')[1]
    var prices = parent.getElementsByClassName('price-list')[0]
    var selected = names.selectedIndex-1

    var quan = parent.getElementsByClassName('final-select')[3]
    var no = parent.getElementsByClassName('final-select')[4]
    quan.selectedIndex = selected
    no.selectedIndex = selected

    var selectedPrice = prices.options[selected].value
    var quantity = parent.getElementsByClassName("final-select")[0].value

    parent.getElementsByClassName('final-select')[2].value = selectedPrice * quantity
}

function getTotal(){
    var price = document.getElementsByClassName('sum-price')
    var total = 0
    for(var i = 0; i<price.length; i++)
        total += parseInt(price[i].value)
        
    document.getElementById('total-price').value = total
}

function downloadDocument(){
    const element = document.getElementById('official-reciept')
    html2pdf()
    .from(element)
    .save()
    console.log('success!');
}

function modifyQuantity(str){
    switch(str){
        case 'debit':
            var quantity = document.getElementById('inventory_quantity').value
            quantity = parseInt(quantity)
            var num = document.getElementById('debit').value
            num = parseInt(num)   
            quantity += num
            document.getElementById('inventory_quantity').value = quantity
            break
        case 'credit':
            var quantity = document.getElementById('inventory_quantity')
            var num = document.getElementById('credit').value
            quantity.value -= num
            break
    }
}   