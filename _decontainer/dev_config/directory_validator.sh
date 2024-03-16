#!/bin/bash

# Full path of the destination folders
folder_path_testfunzionamento="./gestione_verbali/utenti/testfunzionamento"
folder_path_buglianopisa="./gestione_verbali/utenti/buglianopisa"
source_path="./gestione_verbali/utenti/"

# Full path of the source folders (compressed files)
compress_testfunzionamento=".devcontainer/dev_docs/testfunzionamento.zip"
compress_buglianopisa=".devcontainer/dev_docs/buglianopisa.zip"

if [ -d "$source_path" ]; then
  # Check if the destination directories exist, and print a message if they do
  if [ -d "$folder_path_testfunzionamento" ]; then
   echo "📁 testfunzionamento already exists at the destination location."
    else
        unzip -q -d "$folder_path_testfunzionamento" "$compress_testfunzionamento"
        if [ $? -eq 0 ]; then
          echo "🎉 Decompression successful for testfunzionamento."
        else
          echo "❌ Decompression error for testfunzionamento."
        fi
  fi    
  # Check if the destination directories exist, and print a message if they do
  if [ -d "$folder_path_buglianopisa" ]; then
      echo "📁 buglianopisa already exists at the destination location."

    else
        unzip -q -d "$folder_path_buglianopisa" "$compress_buglianopisa"
        if [ $? -eq 0 ]; then
          echo "🎉 Decompression successful for buglianopisa."
        else
          echo "❌ Decompression error for buglianopisa."
        fi
  fi
  else 
   if [ ! -d "$source_path" ]; then
    mkdir -p "$source_path"
    # Extract the contents from the source folders (compressed files) to the destination folders
    unzip -q -d "$folder_path_testfunzionamento" "$compress_testfunzionamento"
    unzip -q -d "$folder_path_buglianopisa" "$compress_buglianopisa"
    # Check the exit status of the unzip commands
    if [ $? -eq 0 ]; then
      echo "🎉 Decompression successful for testfunzionamento and buglianopisa."
    else
      echo "❌ Decompression error for testfunzionamento and buglianopisa."
    fi
  fi
fi
  