<h1>Create a Report</h1>

{INSTRUCTIONS:}
<p>Use the following form to create a report.</p>

<p>Note that a report is just SQL with special placeholders where you want to
insert a replaceable parameter.  A parameter is of the form
<tt>{name,datatype}</tt> where <tt>name</tt> must be a single word and
<tt>datatype</tt> is one of</p>

<ul>
    <li>number</li>
    <li>date</li>
    <li>words</li>
    <li>email</li>
    <li>datetime</li>
</ul>

<p>If you don't want to constrain the type of data the user must enter, just
write the parameter as <tt>{name,}</tt>.</p>

<p>The system will prompt the user for a value for this parameter when executing
the report.  Reports cannot contain any of the SQL words <tt>insert</tt>,
<tt>update</tt>, <tt>delete</tt>, or other modifying words.  They are
read-only.</p>
{:INSTRUCTIONS}

{BAD:}
<p class="error">There were some disallowed words in the query.  Please remove
the following words from your query:</p>
<ol>
  {ITEM:}
  <li><tt>{WORD}</tt></li>
  {:ITEM}
</ol>
{:BAD}

{FORM}
