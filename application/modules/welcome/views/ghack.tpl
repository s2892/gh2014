{extends file="master.tpl"}

{* This block is defined in the master.php template *}
{block name=menu}
    {foreach $cat as $ca}

    <li><a  class="btn  btn-success" href="/cat/{$ca->id}">{$ca->name}</a></li>

    {/foreach}
{/block}
{block name=js}
   $questions =  {$question|@json_encode};
    $category =  {$category|@json_encode};
{/block}
{block name=header}
    <h1 class="page-header">{$category.name}  <span id="y_h"></span></h1>
{/block}
{* This block is defined in the master.php template *}
{block name=body}
    {foreach $question as $d}
        {$d->name}
    {/foreach}
{/block}