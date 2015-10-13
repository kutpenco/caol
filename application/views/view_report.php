<div id="page-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">Sistema de Atendimento</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
    <!-- /.row -->
    <div class="row">
        <div class="col-lg-12">
            <h3>Selecione a opção da lista</h3>
        </div>
        <div class="col-lg-12">
            <form id = "frmFilterPeople" action="<?=base_url('consultor/ajax-get-relatorio/'.$tipo_relatorio)?>" method="post" accept-charset="utf-8">
                <select data-placeholder="Lista de <?=$title;?>" id="peopleLst" name= "peopleList[]" multiple class="chosen" style="width: 100%;" data-ajax-data-type="<?=$ajax_data_type;?>">
                    <option value=""></option>
<?php foreach ($records as $row):?>
                    <option value="<?=$row->co_usuario;?>"><?=$row->no_usuario;
?></option>
<?php endforeach?>
                </select>
            </form>
            <span id="loading" class="hide"><i class="fa fa-spinner fa-spin"></i> Carregando...</span>
        </div>
    </div>
    <!-- /.row -->
    <div class="row">
        <div id="relatorio_table">
        </div>
    </div>
    <!-- /.row -->
</div>
<!-- /#page-wrapper -->