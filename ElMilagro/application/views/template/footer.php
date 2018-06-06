    <footer class="main-footer">
        <div class="pull-right hidden-xs">
           <strong>Desarrollado por: <a href="">Enigma.</a></strong>
        </div>
        <strong>Copyright &copy; 2018 <a href="">Enigma</a>.</strong> Todos los derechos reservados.
    </footer>

    <script>
        function dinamicMenu() {
            var url = window.location;
            var aux = url.href.split('/');
            var path = url.href;

            if($.isNumeric(aux[aux.length-1]))
            {

                var aux_url = path.substring(0, path.length-1);
                path = aux_url+"1";
                console.log(path);
            }

            else if(aux[aux.length-2] === 'pendiente')
            {
                var path = '';

                for(var i = 0; i < aux.length-1; i++)
                {
                    path += aux[i]+'/';
                }
                path += 'todos';

            }
            else if(aux[aux.length-2] === 'incidente')
            {
                var path = '';

                for(var i = 0; i < aux.length-1; i++)
                {
                    path += aux[i]+'/';
                }
                path += 'historial';
            }

            else if(aux[aux.length-1] === 'editar')
            {
                var path = '';

                for(var i = 0; i < aux.length-1; i++)
                {
                    path += aux[i]+'/';
                }

                if(aux[aux.length-2] === 'parte_afectada' || aux[aux.length-2] === 'hipotesis')
                {
                    path += 'todas';
                }
                else
                {
                    path += 'todos';
                }
            }

            $('.sidebar-menu li a[href="' + path + '"]').parent().addClass('active');
            $('.treeview-menu li a[href="' + path + '"]').parent().addClass('active');
            $('.treeview-menu li a').filter(function() {
                return this.href == path;
            }).parent().parent().parent().addClass('active');
        };
    </script>

    <script>
    $(document).ready(function(){
        dinamicMenu();
    });
    </script>

</body>
</html>