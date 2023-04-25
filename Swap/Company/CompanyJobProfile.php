<!DOCTYPE html>
<html>

<head>
    <title>Job opening Form</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <div class="form-container">
            <h1>Job Opening Form</h1>
            <form action="JobOpening.php" method="post">
                <div class="form-group">
                    <label for="ProfileName">Profile Name:*</label>
                    <select name="ProfileName" id="ProfileName">
                        <option value="SDE">SDE</option>
                        <option value="Finance">Finance</option>
                        <option value="Management">Management</option>
                        <option value="Core">Core</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="JobDescription">Job Description:</label>
                    <input type="text" id="JobDescription" name="JobDescription" placeholder="Enter Job Description">
                </div>
                <div class="form-group">
                    <label for="JobLocation">Job Location:</label>
                    <input type="text" id="JobLocation" name="JobLocation" placeholder="Where will selected candidate work? (Not compulsory)">
                </div>
                <div class="form-group">
                    <label for="MinCPI">Minimum CPI required:*</label>
                    <input type="text" id="MinCPI" name="MinCPI" placeholder="What should be the candidate's minimum CPI?" required>
                </div>
                <div class="form-group">
                    <label for="5p">Back allowed?:*</label>
                    <select name="BackAllowed" id="BackAllowed" required>
                        <option value= 1>Yes</option>
                        <option value= 0 >No</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="GenderSpecific">Gender Specific?:*</label>
                    <select name="GenderSpecific" id="GenderSpecific" required>
                        <option value="ForAll">Open for all</option>
                        <option value="Girls">Only for girls</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="BranchSpecialization">Branch Specialization ?:*</label>
                    <select name="BranchSpecialization[]" id="BranchSpecialization" multiple required>
                    <option value="Open">Open for all</option>
                        <option value="CSE">Computer Science and Engineering</option>
                        <option value="EEE">Electrical and Electronics Engineering </option>
                        <option value="MNC">Maths and Computing</option>
                        <option value="AI/DS">Artificial Intelligence and Data Science</option>
                        <option value="PH">Engineering Physics</option>
                        <option value="MME">Material and Metallurgical Engineering</option>
                        <option value="ME">Mechnical Engineering</option>
                        <option value="CE">Civil Engineering</option>
                        <option value="CH">Chemical Engineering</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Batch">Batch:*</label>
                    <input type="text" id="Batch" name="Batch" placeholder="Enter eligible batch" required>
                </div>
                <div class="form-group">
                    <label for="CTC">CTC (in LPA):</label>
                    <input type="text" id="CTC" name="CTC" placeholder="Enter the CTC being offered">
                </div>
                <div class="form-group">
                    <button type="submit">Submit</button>
                </div>
            </form>
        </div>
    </div>
</body>

</html>