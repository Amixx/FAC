export const transformInpData = (
  inpData: Partial<Record<'tSsr' | 'hda' | 'spa' | 'mSsr' | 'ssg', number>>,
) => {
  return Object.entries(inpData).reduce(
    (acc, [key, value]) => {
      const val = {
        numericValue: value,
        displayValue: `${value} ms`,
      }
      acc[key as keyof typeof acc] = new Array(5).fill(val)
      return acc
    },
    {} as Partial<
      Record<
        'tSsr' | 'hda' | 'spa' | 'mSsr' | 'ssg',
        Array<{ numericValue: number; displayValue: string }>
      >
    >,
  )
}
