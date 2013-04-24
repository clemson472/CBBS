<html>
    
    <head>
    		<base href="http://oss-ci.cs.clemson.edu:8080/GUI%20GROUP/testtree/">
			<link rel="stylesheet media="screen" href="resources/css/style.css" type"text/css"/>
    
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>User Registration</title>
        
        <script language="JavaScript" type="text/javascript">
        
            var common_fields=["username_row","password_row","confirm_row","fname_row","mname_row","lname_row",
                                "preferred_name_row","cell_phone_row","graduation_year_row","major_row","minor_row",
                                "gender_row","permanent_address_row","p_address_row","p_city_row","p_state_row",
                                "p_zip_row","communication_row"];
            var mentee_fields=["cuid_row","clemson_email_row","graduation_month_row","activities_row",
                                "current_address_row","c_address_row","c_city_row","c_state_row","c_zip_row"];
            var mentor_fields=["title_row","preferred_email_row","additional_education_row","community_row",
                                "school_row","degree_row","additional_grad_year_row"];
            var concentrations=["concentration_row","fmgt","mgt","mkt",
                                "psba","psbs",
                                "sba","sbs"];
            
            var hide = 'none';
            var show = ''; 
            
            function change_display_value(fields,value) {
                for (var i=0; i < fields.length; i++) {
                    document.getElementById(fields[i]).style.display = value;
                }
            }
                        
            function change_form() {
            	
            	
                if (document.getElementById("role").value == "mentee") {
                    change_display_value(mentee_fields,show);
                    change_display_value(common_fields,show);
                    change_display_value(mentor_fields,hide);
                } 
                else if (document.getElementById("role").value == "mentor") {
                    change_display_value(mentee_fields,hide);
                    change_display_value(common_fields,show);
                    change_display_value(mentor_fields,show);
                    
                } else {
                    change_display_value(mentee_fields,hide);
                    change_display_value(common_fields,hide);
                    change_display_value(mentor_fields,hide);
                }
             }
             
             function hide_form() {
             	
                change_display_value(mentee_fields,hide);
                change_display_value(common_fields,hide);
                change_display_value(mentor_fields,hide);
                change_display_value(concentrations,hide);
             }
             
             function change_concentration() {
                 major = document.getElementById("major").value;
                 change_display_value(concentrations,hide);
                 switch(major) {
                     case "FinancialManagement":
                         document.getElementById("concentration_row").style.display = '';
                         document.getElementById("fmgt").style.display = '';
                         break;
                     case "Management":
                         document.getElementById("concentration_row").style.display = '';
                         document.getElementById("mgt").style.display = '';
                         break;
                     case "Marketing":
                         document.getElementById("concentration_row").style.display = '';
                         document.getElementById("mkt").style.display = '';
                         break;
                     case "PoliticalScienceBA":
                         document.getElementById("concentration_row").style.display = '';
                         document.getElementById("psba").style.display = '';
                         break;
                     case "PoliticalScienceBS":
                         document.getElementById("concentration_row").style.display = '';
                         document.getElementById("psbs").style.display = '';
                         break;
                     case "SociologyBA":
                         document.getElementById("concentration_row").style.display = '';
                         document.getElementById("sba").style.display = '';
                         break;
                     case "SociologyBS":
                         document.getElementById("concentration_row").style.display = '';
                         document.getElementById("sbs").style.display = '';
                         break;
                 }
                 
             }
                       
        </script>
        
    </head>  
    
    <body onload="hide_form();">
    <?php include("../resources/templates/banner_nolog.html"); ?>
    	        
        <h4>User Registration</h4>
        <p>* Denotes a required field.</p>
        
        <form name="form" >
            
            <table border="0">
                <tr>
                    <td>Program Role</td>
                    <td>
                        <select id="role" style="width: 185px" onchange="change_form();">
                            <option value="select" selected="selected">Select Role</option>
                            <option value="mentee">Mentee</option>
                            <option value="mentor">Mentor</option>
                        </select>
                    </td>
                </tr>
                <tr id="username_row">
                    <td><label id="username_label">Username*</label></td>
                    <td><input id="username" type="text" size="25" /></td>
                </tr>
                <tr id="password_row">
                    <td><label id="password_label">Password*</label></td>
                    <td><input id="password" type="password" size="25" /></td>
                </tr>
                <tr id="confirm_row">
                    <td><label id="confirm_label">Confirm Password*</label></td>
                    <td><input id="confirm" type="password" size="25" /></td>
                </tr>
                <tr id="title_row">
                    <td><label id="title_label">Title (Mentor)</label></td>
                    <td><input id="title" type="text" size="25" /></td>
                </tr>
                <tr id="fname_row">
                    <td><label id="fname_label">First Name*</label></td>
                    <td><input id="fname" type="text" size="25" /></td>
                </tr>
                <tr id="mname_row">
                    <td><label id="mname_label">Middle Name</label></td>
                    <td><input id="mname" type="text" size="25" /></td>
                </tr>
                <tr id="lname_row">
                    <td><label id="lname_label">Last Name*</label></td>
                    <td><input id="lname" type="text" size="25" /></td>
                </tr>
                <tr id="preferred_name_row">
                    <td><label id="preferred_name_label">Preferred Name</label></td>
                    <td><input id="preferred_name" type="text" size="25" /></td>
                </tr>
                <tr id="gender_row">
                    <td><label id="gender_label">Gender</label></td>
                    <td>
                        <select id="gender" style="width: 185px" >
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                            <option value="unknown">Prefer not to say</option>
                        </select>
                    </td>
                </tr>
                
                <tr id="cuid_row">
                    <td><label id="cuid_label">CUID (Mentee)</label></td>
                    <td><input id="cuid" type="text" size="25" /></td>
                </tr>
                <tr id="clemson_email_row">
                    <td><label id="clemson_email_label">Clemson E-mail Address (Mentee)</label></td>
                    <td><input id="clemson_email" type="text" size="25" /></td>
                </tr>
                <tr id="preferred_email_row">
                    <td><label id="preferred_email_label">Preferred E-mail Address (Mentor)</label></td>
                    <td><input id="preferred_email" type="text" size="25" /></td>
                </tr>
                <tr id="cell_phone_row">
                    <td><label id="cell_phone_label">Cell Phone*</label></td>
                    <td><input id="cell_phone" type="text" size="25" /></td>
                </tr>
                <tr id="communication_row">
                    <td><label id="communication_label">Preferred Method of Communication</label></td>
                    <td>
                        <select id="communication" style="width: 185px" >
                            <option value="email">E-mail</option>
                            <option value="phone">Phone</option>
                            <option value="texting">Texting</option>
                        </select>
                    </td>
                </tr>
                <tr id="graduation_year_row">
                    <td><label id="graduation_year_label">Graduation Year</label></td>
                    <td><input id="graduation_year" type="text" size="25" /></td>
                </tr>
                <tr id="graduation_month_row">
                    <td><label id="graduation_month_label">Graduation Month (Mentee)</label></td>
                    <td>
                        <select id="graduation_month" style="width: 185px" >
                            <option value="may">May</option>
                            <option value="august">August</option>
                            <option value="december">December</option>
                        </select>
                    </td>
                </tr>
                <tr id="major_row">
                    <td><label id="major_label">Major</label></td>
                    <td>
                        <select id="major" style="width: 185px" onchange="change_concentration();" >
                            <option value="select" selected="selected">Select Major</option>
                            <option value="Anthropology">Anthropology</option>
                            <option value="Accounting">Accounting </option>
                            <option value="EconomicsBA">Economics BA</option>
                            <option value="EconomicsBS">Economics BS</option>
                            <option value="FinancialManagement">Financial Management</option>
                            <option value="GraphicCommunications">Graphic Communications</option>
                            <option value="Management">Management</option>
                            <option value="Marketing">Marketing</option>
                            <option value="PoliticalScienceBA">Political Science BA</option>
                            <option value="PoliticalScienceBS">Political Science BS</option>
                            <option value="PsychologyBA">Psychology BA</option>
                            <option value="PsychologyBS">Psychology BS</option>
                            <option value="SociologyBA">Sociology BA</option>
                            <option value="SociologyBS">Sociology BS</option>
                        </select>
                    </td>
                </tr>
                <tr id="concentration_row">
                    <td><label id="concentration_label">Concentration</label></td>
                    <td id="fmgt">
                        <select id="financial_management_concentration" style="width: 185px" >
                            <option value="select" selected="selected">Select Concentration</option>
                            <option value="CorporateFinance">Corporate Finance</option>
                            <option value="FinancialPlanning">Financial Planning</option>
                            <option value="FinancialServices">Financial Services</option>
                            <option value="RealEstate">Real Estate</option>
                        </select>
                    </td>
                    <td id="mgt">
                        <select id="management_concentration" style="width: 185px" >
                            <option value="select" selected="selected">Select Concentration</option>
                            <option value="Entrepreneurship">Entrepreneurship</option>
                            <option value="HumanResourcesManagement">Human Resources Management</option>
                            <option value="InternationalManagement">International Management</option>
                            <option value="OperationsManagement">Operations Management</option>
                            <option value="MGTInformationSystems">MGT Information Systems</option>
                            <option value="SupplyChainManagement">Supply Chain Management</option>
                            <option value="GeneralManagement">General Management</option>
                        </select>
                    </td>
                    <td id="mkt">
                        <select id="marketing_concentration" style="width: 185px" >
                            <option value="select" selected="selected">Select Concentration</option>
                            <option value="ServicesMarketing">Services Marketing</option>
                            <option value="SportsMarketing">Sports Marketing</option>
                            <option value="TechnicalMarketing">Technical Marketing</option>
                            <option value="GeneralMarketing">General Marketing</option>
                        </select>
                    </td> 
                    <td id="psba">
                        <select id="political_science_ba_concentration" style="width: 185px" >
                            <option value="select" selected="selected">Select Concentration</option>
                            <option value="AmericanGovernment">American Government</option>
                            <option value="ComparativePolitics">Comparative Politics</option>
                            <option value="InternationalRelations">International Relations</option>
                            <option value="PoliticalTheory">Political Theory</option>
                            <option value="PublicPolicyPublicAdministration">Public Policy &amp; Public Administration</option>
                        </select>
                    </td> 
                    <td id="psbs">
                        <select id="political_science_bs_concentration" style="width: 185px" >
                            <option value="select" selected="selected">Select Concentration</option>
                            <option value="AmericanPolitics">American Politics</option>
                            <option value="GlobalPolitics">Global Politics</option>
                            <option value="PublicPolicy">Public Policy</option>
                            <option value="PublicAdminstration">Public Adminstration</option>
                        </select>
                    </td>
                    <td id="sba">
                        <select id="sociology_ba_concentration" style="width: 185px" >
                            <option value="select" selected="selected">Select Concentration</option>
                            <option value="GeneralSociology">General Sociology</option>
                            <option value="Criminal Justice">Criminal Justice</option>
                            <option value="SocialService">Social Service</option>
                            <option value="CommunityStudies">Community Studies</option>
                        </select>
                    </td>  
                    <td id="sbs">
                        <select id="sociology_bs_concentration" style="width: 185px" >
                            <option value="select" selected="selected">Select Concentration</option>
                            <option value="GeneralSociology">General Sociology</option>
                            <option value="Criminal Justice">Criminal Justice</option>
                            <option value="SocialService">Social Service</option>
                            <option value="CommunityStudies">Community Studies</option>
                        </select>
                    </td> 
                </tr>
                <tr id="minor_row">
                    <td><label id="minor_label">Minor</label></td>
                    <td>
                        <select id="minor" style="width: 185px" >
                            <option value="select" selected="selected">Select Minor</option>
                            <option value="Accounting">Accounting</option>
                            <option value="Adult/ExtensionEducation">Adult/Extension Education</option>
                            <option value="AerospaceStudies">Aerospace Studies</option>
                            <option value="AgriculturalBusinessManagement">Agricultural Business Management</option>
                            <option value="AgriculturalMechanizationBusiness">Agricultural Mechanization &amp; Business</option>
                            <option value="AmericanSignLanguageStudies">American Sign Language Studies</option>
                            <option value="AnimalVeterinarySciences">Animal &amp; Veterinary Sciences</option>
                            <option value="Anthropology">Anthropology</option>
                            <option value="Architecture">Architecture</option>
                            <option value="Art">Art</option>
                            <option value="AthleticLeadership">Athletic Leadership</option>
                            <option value="Biochemistry">Biochemistry</option>
                            <option value="BiologicalSciences">Biological Sciences</option>
                            <option value="BusinessAdministration">Business Administration</option>
                            <option value="Chemistry">Chemistry</option>
                            <option value="CommunicationStudies">Communication Studies</option>
                            <option value="ComputerScience">Computer Science</option>
                            <option value="CropSoilEnvironmentalScience">Crop &amp; Soil Environmental Science</option>
                            <option value="DigitalProductionArts">Digital Production Arts</option>
                            <option value="EastAsianStudies">East Asian Studies</option>
                            <option value="Economics">Economics</option>
                            <option value="Education">Education </option>
                            <option value="English">English</option>
                            <option value="Entomology">Entomology</option>
                            <option value="Entrepreneurship">Entrepreneurship</option>
                            <option value="EnvironmentalEngineering">Environmental Engineering</option>
                            <option value="EnvironmentalSciencesPolicy">Environmental Sciences &amp; Policy</option>
                            <option value="EquineBusiness">Equine Business</option>
                            <option value="FilmStudies">Film Studies</option>
                            <option value="FinancialManagement">Financial Management</option>
                            <option value="FoodSciences">Food Sciences</option>
                            <option value="ForestProducts">Forest Products</option>
                            <option value="ForestResourceManagement">Forest Resource Management</option>
                            <option value="Genetics">Genetics</option>
                            <option value="Geography">Geography</option>
                            <option value="Geology">Geology</option>
                            <option value="GlobalPolitics">Global Politics</option>
                            <option value="GreakWorks">Greak Works</option>
                            <option value="History">History</option>
                            <option value="Horticulture ">Horticulture</option>
                            <option value="HumanResourcesManagement">Human Resources Management</option>
                            <option value="InternationalEngineeringScience">International Engineering &amp; Science</option>
                            <option value="LegalStudies">Legal Studies</option>
                            <option value="Management">Management</option>
                            <option value="ManagementInformationSystems">Management Information Systems</option>
                            <option value="MathematicalSciences">Mathematical Sciences</option>
                            <option value="Microbiology">Microbiology</option>
                            <option value="MilitaryLeadership">Military Leadership</option>
                            <option value="ModernLanguages">Modern Languages</option>
                            <option value="Music">Music</option>
                            <option value="NaturalResourcesEconomics">Natural Resources Economics</option>
                            <option value="NonprofitLeadership">Nonprofit Leadership</option>
                            <option value="PackagingScience">Packaging Science</option>
                            <option value="PanAfricanStudies">Pan African Studies</option>
                            <option value="ParkProtectedAreaManagement">Park &amp; Protected Area Management</option>
                            <option value="Philosophy">Philosophy</option>
                            <option value="Physics">Physics</option>
                            <option value="PlantPathology">Plant Pathology</option>
                            <option value="PoliticalScience">Political Science</option>
                            <option value="Psychology">Psychology</option>
                            <option value="PublicPolicy">Public Policy</option>
                            <option value="Religion">Religion</option>
                            <option value="RussianAreaStudies">Russian Area Studies</option>
                            <option value="ScienceTechnologySociety">Science &amp; Technology in Society</option>
                            <option value="Screenwriting">Screenwriting</option>
                            <option value="Sociology">Sociology</option>
                            <option value="SpanishAmericanAreaStudies">Spanish-American Area Studies</option>
                            <option value="Theatre">Theatre</option>
                            <option value="TherapeuticRecreation">Therapeutic Recreation</option>
                            <option value="TravelTourism">Travel &amp; Tourism</option>
                            <option value="Turfgrass">Turfgrass</option>
                            <option value="UrbanForestry">Urban Forestry</option>
                            <option value="WildlifeFisheriesBiology">Wildlife &amp; Fisheries Biology</option>
                            <option value="WomenStudies">Women's Studies</option>
                            <option value="Writing">Writing</option>
                            
                        </select> 
                    </td>
                </tr>
                <tr id="additional_education_row">
                    <td><label id="additional_education_label">Additional Education (Mentor)</label></td>
                </tr>
                <tr id="school_row">
                    <td><label id="school_label">School</label></td>
                    <td><input id="school" type="text" size="25" /></td>                    
                </tr>
                <tr id="degree_row">
                    <td><label id="degree_label">Degree</label></td>
                    <td><input id="degree" type="text" size="25" /></td>
                </tr>
                <tr id="additional_grad_year_row">
                    <td><label id="additional_grad_year_label">Graduation Year</label></td>
                    <td><input id="additional_grad_year" type="text" size="25" /></td>
                </tr>
                <tr id="activities_row">
                    <td><label id="activities_label">Activities/Campus Involvement (Mentee)</label></td>
                    <td><textarea id="activities" rows="4" ></textarea></td>
                </tr>
                <tr id="community_row">
                    <td><label id="community_label">Community/Professional Interests/<br>Organizations (Mentor)</label></td>
                    <td><textarea id="community" rows="4" ></textarea></td>
                </tr>
                <tr id="current_address_row">
                    <td><label id="current_address_label">Current Address (Mentee)</label></td>
                </tr>
                <tr id="c_address_row">
                    <td><label id="c_address_label">Address*</label></td>
                    <td><input id="c_address" type="text" size="25" /></td>
                </tr>
                <tr id="c_city_row">
                    <td><label id="c_city_label">City*</label></td>
                    <td><input id="c_city" type="text" size="25" /></td>
                </tr>
                <tr id="c_state_row">
                    <td><label id="c_state_label">State*</label></td>
                    <td><input id="c_state" type="text" size="25" /></td>
                </tr>
                <tr id="c_zip_row">
                    <td><label id="c_zip_label">Zip*</label></td>
                    <td><input id="c_zip" type="text" size="25" /></td>
                </tr>
                <tr id="permanent_address_row">
                    <td><label id="permanent_address_label">Permanent Address</label></td>
                </tr>
                <tr id="p_address_row">
                    <td><label id="p_address_label">Address*</label></td>
                    <td><input id="p_address" type="text" size="25" /></td>
                </tr>
                <tr id="p_city_row">
                    <td><label id="p_city_label">City*</label></td>
                    <td><input id="p_city" type="text" size="25" /></td>
                </tr>
                <tr id="p_state_row">
                    <td><label id="p_state_label">State*</label></td>
                    <td><input id="p_state" type="text" size="25" /></td>
                </tr>
                <tr id="p_zip_row">
                    <td><label id="p_zip_label">Zip*</label></td>
                    <td><input id="p_zip" type="text" size="25" /></td>
                </tr>
            

            </table>
        </form>        
        <p><br/><a href="Registration/register.php">Previous</a></p>
        <p><a href="Registration/register3.php">Next</a></p>
    </body>
    
</html>
