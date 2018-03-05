<div class="container-fluid">
        <div class="row">
          <div id="asesor"></div>
        </div>
      </div>
      <scr

<script type="text/javascript">

function anexGrid_selectEstado(config) {
    config = {
        class: config.class !== undefined ? config.class : '',
        style: config.style !== undefined ? config.style : '',
        attr: config.attr !== undefined ? config.attr : [],

        selected: config.selected !== undefined ? config.selected : '',
        data: config.data !== undefined ? config.data : [],
    };

    var atributos = '';
    $.each(config.attr, function (i, v) {
        atributos += v;
    })

    config.attr = atributos;

    var control = $('<select style="' + config.style + '" class="form-control input-sm ' + config.class + '" ' + config.attr + '></select>');


    //   $.ajax({
    //       type: "POST",
    //       url: "verEstados.php",
    //       success: function (data) {
    //         $.each(config.data, function (i, d) {
    //           control.append(response);
    //         });
    //     }
    // });
    $.each(config.data, function (i, d) {
        control.append('<option ' + (d.valor == config.selected ? 'selected' : '') + ' value="' + d.valor + '">' + d.contenido + '</option>');
    })
        // var url="verEstados.php";
        // $.getJSON(url,function(i,d){
        //       $.each(config.data, function(i,d){
                            
        //                       // var id_est = estadoA.id_est;
        //                       // var desc_est = estadoA.desc_est;
        //     control.append('<option value="' + d.id_est + '">' + d.desc_est + '</option>');
                            
        //                   });
        //               });

        return control;
    }

var grid = $("#asesor").anexGrid({
                  class: 'table table-striped',
                  columnas: [
                    { leyenda: '', style: 'width:10px;', columna: 'estado'},
                    { leyenda: 'Telefono', style: 'width:100px;', filtro: true, columna: 'tMovil' },
                    { leyenda: 'Nombre', style: 'width:130px;', filtro: true, columna: 'nombre' },
                    { leyenda: 'Estado', columna: 'estado', style: 'width:100px;', filtro: function(){
                       return anexGrid_selectEstado({
                           data: [
                               {valor: '', contenido:'TODOS'},
                               {valor: '1', contenido:'SIN ESTADO'},
                               {valor: '14', contenido:'NO CONTESTA'},
                               {valor: '16', contenido:'SEGUIMIENTO'},
                               {valor: '19', contenido:'EN PROCESO'}
                           ]
                       });
                    }},
                    {leyenda: 'ProximaAcción', columna: 'proxi_acci', style: 'width:90px;', filtro: function(){
                        return anexGrid_select({
                            data: [
                                {valor: '', contenido:'TODOS'},
                                {valor: '1', contenido:'Sin Acción'},
                                {valor: '2', contenido:'Volver a Llamar'},
                                {valor: '4', contenido:'Cita Oficina'},
                                {valor: '9', contenido:'No Contesto Llamada 1'},
                                {valor: '10', contenido:'No Contesto Llamada 2'},
                                {valor: '11', contenido:'No Contesto Llamada 3'},
                                {valor: '13', contenido:'Llamar en 3 meses'},
                                {valor: '14', contenido:'Llamar en 6 meses'},
                                {valor: '15', contenido:'Llamar en 8 meses'},
                                {valor: '16', contenido:'No Llamar'}
                            ]
                        });
                    }},
                    { leyenda: 'Ciudad', style: 'width:90px;', filtro: true, columna: 'ciudad' },
                    { leyenda: 'Pais', style: 'width:100px;', filtro: true, columna: 'pais' },
                    { leyenda: 'FechaRegistro', style: 'width:130px;', filtro: true, columna: 'fecha_a' },
                    { leyenda: 'FechaAsignación', style: 'width:130px;', filtro: true, columna: 'fecha_asig' },
                    { leyenda: '', style: 'width:10px;', class: 'text-center'},
                  ],
                modelo: [
                { propiedad: 'estado.desc_est', formato:function(tr, obj, celda){
                       if(celda == 'SIN ESTADO') return '<td bgcolor="#FFFA7B"><span class="glyphicon glyphicon-option-horizontal"></span></td>'
                       if(celda == 'NO LE INTERESA') return '<td bgcolor="#FF7070"><span class="glyphicon glyphicon-remove-circle"></span></td>'
                       if(celda == 'NO CALIFICA') return '<td bgcolor="#FF7070"><span class="glyphicon glyphicon-thumbs-down"></span></td>'
                       if(celda == 'NUMERO ERRONEO') return '<td bgcolor="#FF7070"><span class="glyphicon glyphicon-ban-circle"></span></td>'
                       if(celda == 'VENTA') return '<td bgcolor="#8CF8A0"><span class="glyphicon glyphicon-thumbs-up"></span></td>'
                       if(celda == 'NO CONTESTA') return '<td bgcolor="#FFD052"><span class="glyphicon glyphicon-earphone"></span></td>'
                       if(celda == 'SEGUIMIENTO') return '<td bgcolor="#52D8FF"><span class="glyphicon glyphicon-record"></span></td>'
                       if(celda == 'EN PROCESO') return '<td bgcolor="#52D8FF"><span class="glyphicon glyphicon-eye-open"></span></td>'
                }},
                { propiedad: 'tMovil' },
                { propiedad: 'nombre' },
                { propiedad: 'estado.desc_est' },
                { propiedad: 'proxi_acci.desc_proxi_acci'},
                { propiedad: 'ciudad' },
                { propiedad: 'pais' },
                { propiedad: 'fecha_a'},
                { propiedad: 'fecha_asig'},
                { class:'text-center', formato: function(tr, obj, celda){
                  return anexGrid_boton({
                      contenido: '<i class="glyphicon glyphicon-edit"></i>',
                      class: 'editar',
                      style: 'color:#337ab7;border:none;',
                      value: tr.data('fila')
                    });
                  // return anexGrid_link({
                  //     contenido: '<i class="glyphicon glyphicon-pencil"></i>',
                  //     href: '#editar',
                  //     attr: [ 'onclick="GetUserDetails('+ obj.idregistro +')"' ]
                  // });
                }},
                ],
              url: 'datas/dataAsesores.php',
              paginable: true,
              filtrable: true,
              limite: [20, 40, 60],
              columna: 'fecha_asig',
              columna_orden: 'DESC'
          });
          
       </script>
