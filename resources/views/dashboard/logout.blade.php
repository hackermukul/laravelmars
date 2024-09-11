<form method="POST" action="{{ route('logout') }}" class="inline" id="member_signup">
         @csrf
   </form>

                <script>
                window.onload = function(){
  document.forms['member_signup'].submit();
}
                </script>