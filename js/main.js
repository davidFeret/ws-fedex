
const btnAddRow = document.getElementById('add-row');
const btnDeleteLast = document.getElementById('delete-last');
const btnConfirmData = document.getElementById('confirm-data');
const loading = document.getElementById('loading');

const closeButtonAlert = document.getElementById('close-button-alert');
const alertMessage = document.getElementById('alert-message');

const objectAddress = {
    street : '',
    city   : '',
    state  : '',
    cp     : '',
};
const inputDefaultPackageValues = {
    weight: 11.39,
    length: 0.66,
    height: 0.7,
    width: 0.75,
};
let items = [];
let shippingAddress  = { ...objectAddress };
let recipientAddress = { ...objectAddress };
let quantityRows = 0;

const createInputCol = ( id, placeholder, value ) => {

    const col = document.createElement('div');
    col.className = 'col';

    const input = document.createElement('input');
    input.id = id;
    input.className = 'form-control';
    input.placeholder = placeholder;
    input.type = 'number';
    input.value = value;

    col.appendChild( input );

    return col;
}

const createNewRow = ({ position, defaultValues = false }) => {

    const form = document.getElementById('formRate');

    const container = document.createElement('div');
    container.id = `container_${ position }`;

    const hr = document.createElement('hr');

    const createRow = document.createElement('div');
    createRow.className = 'row';

    const inputWeight = createInputCol(`peso_${ position }`, 'Peso (KG)', defaultValues ? inputDefaultPackageValues.weight : '');
    const inputHeight = createInputCol(`alto_${ position }`, 'Alto (Metros)', defaultValues ? inputDefaultPackageValues.height : '');
    const inputLength = createInputCol(`largo_${ position }`, 'Largo (Metros)', defaultValues ? inputDefaultPackageValues.length : '');
    const inputWidth = createInputCol(`ancho_${ position }`, 'Ancho (Metros)', defaultValues ? inputDefaultPackageValues.width : '');

    createRow.appendChild( inputWeight );
    createRow.appendChild( inputHeight );
    createRow.appendChild( inputLength );
    createRow.appendChild( inputWidth );

    container.appendChild( createRow );
    container.appendChild( hr );

    form.appendChild( container );

    quantityRows++;
}

const deleteLastRow = () => {

    if( quantityRows > 0 ) {
        let elementToDelete = document.getElementById(`container_${ quantityRows - 1 }`);
        elementToDelete.parentNode.removeChild(elementToDelete);
    
        quantityRows--;
    }
}

const createItem = ({ weight = 1, length = 1, height = 1, width = 1 }) => {

    weight = ( weight > 0 ) ? weight : 1;
    length = ( length > 0 ) ? length : 1;
    height = ( height > 0 ) ? height : 1;
    width = ( width > 0 ) ? width : 1;

    const item = {
        'SequenceNumber': 1,
        'GroupPackageCount': 1,
        'Weight': {
            'Value': weight,
            'Units': 'KG',
        },
        'Dimensions': {
            'Length': ( length * 100 ),
            'Height': ( height * 100 ),
            'Width': ( width * 100 ),
            'Units': 'CM',
        },
    };

    return item;
}

const tableRowEmptyMessage = () => {

    const tr = document.createElement('tr');

    const td = document.createElement('td');
    td.colSpan = 3;
    td.textContent = 'Sin resultados disponibles';

    tr.appendChild( td );

    return tr;
}

const addRowsToTable = ( rows ) => {

    let elementToDelete = document.getElementById('tbody-result');

    if( elementToDelete ) {
        elementToDelete.parentNode.removeChild( elementToDelete );
    }

    const table = document.getElementById('table-result');

    const tbody = document.createElement('tbody');
    tbody.id = 'tbody-result';

    rows.forEach( row => {
        tbody.appendChild( row );
    });
    
    table.appendChild( tbody );
}

const getListItems = () => {

    items = [];

    for (let index = 0; index < quantityRows; index++) {

        const weight = document.getElementById(`peso_${ index }`).value;
        const length = document.getElementById(`alto_${ index }`).value;
        const height = document.getElementById(`largo_${ index }`).value;
        const width = document.getElementById(`ancho_${ index }`).value;

        const item = createItem({ weight, length, height, width });

        items = [ ...items, item ];
    }
}

const getShippingCost = () => {

    const resp = ajax( {
        url: 'http://localhost/fedex/index.php/welcome/getShippingCost',
        method: 'POST',
        data: { data: items, shipping: shippingAddress, recipient: recipientAddress },
    });

    return resp;
}

const getShippingAddress = () => {
    const inputStreet = document.getElementById('origenCalles');
    const inputCity   = document.getElementById('origenCiudad');
    const inputState  = document.getElementById('origenEstado');
    const inputCP     = document.getElementById('origenCP');

    shippingAddress.street = inputStreet.value;
    shippingAddress.city   = inputCity.value;
    shippingAddress.state  = inputState.value;
    shippingAddress.cp     = inputCP.value;
}

const getRecipientAddress = () => {
    const inputStreet = document.getElementById('destinoCalles');
    const inputCity   = document.getElementById('destinoCiudad');
    const inputState  = document.getElementById('destinoEstado');
    const inputCP     = document.getElementById('destinoCP');

    recipientAddress.street = inputStreet.value;
    recipientAddress.city   = inputCity.value;
    recipientAddress.state  = inputState.value;
    recipientAddress.cp     = inputCP.value;
}

const resultToRows = ( result ) => {

    // console.log({resultToRows: result});

    result = Array.isArray( result ) ? result : [ result ];

    const rows = result.map( item => {
        const tr = document.createElement('tr');

        const tdDeliveryTimestamp = document.createElement('td');
        const tdTypeService = document.createElement('td');
        const tdCost = document.createElement('td');

        const deliveryTimestamp = item.DeliveryTimestamp;
        const typeService = item.ServiceType;
        const cost = ( item.RatedShipmentDetails && Array.isArray( item.RatedShipmentDetails ) )
            ? `${item.RatedShipmentDetails[1].ShipmentRateDetail.TotalNetCharge.Amount} ${item.RatedShipmentDetails[1].ShipmentRateDetail.TotalNetCharge.Currency}`
            : `${item.RatedShipmentDetails.ShipmentRateDetail.TotalNetCharge.Amount} ${item.RatedShipmentDetails.ShipmentRateDetail.TotalNetCharge.Currency}`;

        tdCost.textContent = cost;
        tdTypeService.textContent = typeService;
        tdDeliveryTimestamp.textContent = deliveryTimestamp;

        tr.appendChild( tdTypeService );
        tr.appendChild( tdCost );
        tr.appendChild( tdDeliveryTimestamp );

        return tr;
    });

    return rows;

}

const confirmData = async () => {

    getListItems();
    getShippingAddress();
    getRecipientAddress();

    try {
        loading.className = 'alert alert-info';
        btnConfirmData.disabled = true;

        const resp = await getShippingCost();

        loading.className = 'alert alert-info d-none';
        btnConfirmData.disabled = false;

        // console.log({resp});

        if( resp.ok ) {
            // const alerta = document.getElementById('alerta');
            const { 
                HighestSeverity,

                RateReplyDetails, 
                Notifications: { Severity, Message } 
            } = resp.data;

            // if( Severity === 'SUCCESS' || Severity === 'NOTE' || Severity === 'WARNING' ) {
            //     const rows = resultToRows( RateReplyDetails );
    
            //     addRowsToTable( rows );
            // } else {
            //     addRowsToTable([ tableRowEmptyMessage() ]);
            // }
            if( Severity === 'ERROR' ) {
                addRowsToTable([ tableRowEmptyMessage() ]);
            } else {
                const rows = resultToRows( RateReplyDetails );
    
                addRowsToTable( rows );
            }
            // alerta.innerHTML = `
            //     Severity: ${ Severity } <br>
            //     Message: ${ Message } <br>
            // `;
        } else {
            console.log('resp.ok = false');
            addRowsToTable([ tableRowEmptyMessage() ]);
        }
        
    } catch (error) {
        console.log(error);
        addRowsToTable([ tableRowEmptyMessage() ]);
    }
}

const addDefaultOriginValue = () => {
    /** Shipper */
    const inputStreet = document.getElementById('origenCalles');
    const inputCity   = document.getElementById('origenCiudad');
    const inputState  = document.getElementById('origenEstado');
    const inputCP     = document.getElementById('origenCP');

    inputStreet.value = 'Francisco Villa';
    inputCity.value   = 'Mazatlán';
    inputState.value  = 'Sinaloa';
    inputCP.value     = '82127';
}

const addDefaultDestinationValue = () => {
    /** Recipient */
    const inputStreet = document.getElementById('destinoCalles');
    const inputCity   = document.getElementById('destinoCiudad');
    const inputState  = document.getElementById('destinoEstado');
    const inputCP     = document.getElementById('destinoCP');

    inputStreet.value = 'Una calle de Escuinapa';
    inputCity.value   = 'Escuinapa';
    inputState.value  = 'Sinaloa';
    inputCP.value     = '82400';
}

createNewRow({ position: quantityRows, defaultValues: true });
addRowsToTable([ tableRowEmptyMessage() ]);
addDefaultOriginValue();
addDefaultDestinationValue();

btnAddRow.addEventListener('click', () => createNewRow({ position: quantityRows }));
btnDeleteLast.addEventListener('click', deleteLastRow);
btnConfirmData.addEventListener('click', confirmData);

closeButtonAlert.addEventListener('click', () => {
    alertMessage.className='d-none';
});