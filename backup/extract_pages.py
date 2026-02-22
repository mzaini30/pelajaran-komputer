import PyPDF2

# Open the source PDF file
with open('word + excel.pdf', 'rb') as source_pdf:
    # Create a PDF reader object
    pdf_reader = PyPDF2.PdfReader(source_pdf)
    
    # Create a PDF writer object
    pdf_writer = PyPDF2.PdfWriter()
    
    # Add pages 12-19 (remember Python uses 0-based indexing, so pages 11-18 in 0-indexing)
    # PDF pages are 1-indexed, so we need to extract pages 12-19 (which are indices 11-18)
    for page_num in range(11, 19):  # 11 to 18 inclusive (which corresponds to pages 12 to 19)
        if page_num < len(pdf_reader.pages):
            pdf_writer.add_page(pdf_reader.pages[page_num])
    
    # Write the extracted pages to a new PDF file
    with open('Word.pdf', 'wb') as output_pdf:
        pdf_writer.write(output_pdf)

print("Pages 12-19 have been extracted and saved as 'Word.pdf'")