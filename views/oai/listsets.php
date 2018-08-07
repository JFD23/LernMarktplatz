<?= '<?xml version="1.0" encoding="UTF-8"?>' ?>
<OAI-PMH xmlns="http://www.openarchives.org/OAI/2.0/" 
         xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
         xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/
         http://www.openarchives.org/OAI/2.0/OAI-PMH.xsd">
 <responseDate>2002-08-11T07:21:33Z</responseDate>
 <request verb="ListSets">http://an.oa.org/OAI-script</request>
 <ListSets>
  <set>
    <setSpec>music</setSpec>
    <setName>Music collection</setName>
  </set>
  <set>
    <setSpec>music:(muzak)</setSpec>
    <setName>Muzak collection</setName>
  </set>
  <set>
    <setSpec>music:(elec)</setSpec>
    <setName>Electronic Music Collection</setName>
    <setDescription>
      <oai_dc:dc 
          xmlns:oai_dc="http://www.openarchives.org/OAI/2.0/oai_dc/" 
          xmlns:dc="http://purl.org/dc/elements/1.1/" 
          xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" 
          xsi:schemaLocation="http://www.openarchives.org/OAI/2.0/oai_dc/ 
          http://www.openarchives.org/OAI/2.0/oai_dc.xsd">
          <dc:description>This set contains metadata describing 
             electronic music recordings made during the 1950ies
             </dc:description>
       </oai_dc:dc>
    </setDescription>
   </set>
   <set>
    <setSpec>video</setSpec>
    <setName>Video Collection</setName>
   </set>
 </ListSets>
</OAI-PMH>