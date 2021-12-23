<?php require APPROOT . '/views/inc/header.php'; ?>

<div style="font-size: 1.6rem;">

    <?php // Unfinished Pagination, is broken when searching for specific emails that are more than 10 because it reloads url and resets data
      $page = !empty( $_GET['page'] ) ? (int) $_GET['page'] : 1;
      $total = count( $data['emails'] ); //total items in array    
      $limit = 10; //per page    
      $totalPages = ceil( $total/ $limit ); //calculate total pages
      $page = max($page, 1); //get 1 page when $_GET['page'] <= 0
      $page = min($page, $totalPages); //get last page when $_GET['page'] > $totalPages
      $offset = ($page - 1) * $limit;
      if( $offset < 0 ) $offset = 0;

      $data['emails'] = array_slice( $data['emails'], $offset, $limit );

      $link = 'data?page=%d';
      $pagerContainer = '<div style="width: 300px;">';   
      if( $totalPages != 0 ) 
      {
        if( $page == 1 ) 
        { 
          $pagerContainer .= ''; 
        } 
        else 
        { 
          $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> &#171; prev page</a>', $page - 1 ); 
        }
        $pagerContainer .= ' <span> page <strong>' . $page . '</strong> from ' . $totalPages . '</span>'; 
        if( $page == $totalPages ) 
        { 
          $pagerContainer .= ''; 
        }
        else 
        { 
          $pagerContainer .= sprintf( '<a href="' . $link . '" style="color: #c00"> next page &#187; </a>', $page + 1 ); 
        }           
      }                   
      $pagerContainer .= '</div>';
      
      echo $pagerContainer;
      ?>


    <div>
        <form action="<?php echo URLROOT; ?>/data" method="post" id="emailData">

            Search: <input type="text" name="keyword" /><br />
            <label for="sort">Sort by:</label>
            <select name="sort" id="sort">
                <option value="date">Date</option>
                <option value="name">Name</option>
            </select>

            <input type="submit" name="btnReset" value="Reset">

            <section>
                <label>Filter by emails:</label>
                <?php foreach($data['emailProvider'] as $provider) : ?>
                <input type="submit" id="filter" name="filter" value="<?php echo $provider; ?>">
                <?php endforeach; ?>
            </section>

            <input type="submit" name="btnExport" value="Export as CSV">


            <table style="width:100%">
                <tr>
                    <th>ID</th>
                    <th>Email</th>
                    <th>Date</th>
                    <th>Delete</th>
                </tr>
                <?php foreach($data['emails'] as $email) : ?>
                <tr>
                    <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]'
                            value='<?php echo $email->id; ?>'>
                    </td>
                    <td><?php echo $email->email; ?></td>
                    <td><?php echo $email->created_at; ?></td>
                    <td>
                        <form></form>
                        <form action="<?php echo URLROOT; ?>/delete/<?php echo $email->id; ?>" method="post">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
                <?php endforeach; ?>
            </table>

        </form>
    </div>



</div>