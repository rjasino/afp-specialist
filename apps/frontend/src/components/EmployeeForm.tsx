import React, { useState } from "react";
import type { EmployeeFormData } from "../types/employee";
import { createEmployee } from "../services/employeeService";

function EmployeeForm() {
  const [loading, setLoading] = useState(false);

  const handleSubmit = async (event: React.FormEvent<HTMLFormElement>) => {
    event.preventDefault();
    setLoading(true);

    const cleanedData: EmployeeFormData = {
      email: event.currentTarget.email.value.toString().trim(),
      last_name: event.currentTarget.last_name.value.toString().trim(),
      first_name: event.currentTarget.first_name.value.toString().trim(),
      gender: event.currentTarget.gender.value.toString(),
      birthday: event.currentTarget.birthday.value.toString(),
      date_hired: event.currentTarget.date_hired.value.toString(),
      salary: Number(event.currentTarget.salary.value),
    };
  };

  return (
    <>
      <h2>Add New Employee</h2>
      <form onSubmit={handleSubmit}>
        <div>
          <label htmlFor="first_name">First Name:</label>
          <input id="first_name" name="first_name" required type="text" />
        </div>

        <div>
          <label htmlFor="last_name">Last Name:</label>
          <input id="last_name" name="last_name" required type="text" />
        </div>

        <div>
          <label htmlFor="email">Email:</label>
          <input id="email" name="email" required type="email" />
        </div>

        <div>
          <label htmlFor="department_id">Department:</label>
          <select id="department_id" name="department_id" required>
            <option value="">Select Department</option>
            <option value="1">HR</option>
            <option value="2">IT</option>
            <option value="3">Finance</option>
          </select>
        </div>

        <div>
          <label htmlFor="salary">Salary:</label>
          <input id="salary" name="salary" required type="number" />
        </div>

        <div>
          <label htmlFor="date_hired">Date Hired:</label>
          <input id="date_hired" name="date_hired" required type="date" />
        </div>

        <div>
          <button type="submit" disabled={loading}>
            {loading ? "Saving..." : "Save"}
          </button>
          <button type="button">Cancel</button>
        </div>
      </form>
    </>
  );
}

export default EmployeeForm;
